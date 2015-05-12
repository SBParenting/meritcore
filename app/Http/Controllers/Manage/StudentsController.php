<?php namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Student as Record;
use App\Models\Campaign;
use App\Models\CampaignStudent;
use App\Models\Classroom;
use App\Models\User;
use App\Models\UserAssoc;
use App\Models\School;
use App\Models\StudentAssoc;
use Illuminate\Http\Request;

class StudentsController extends Controller {

	public function postStudentAdd(Request $request)
	{
		$this->validate($request, [
			'school_id'           => 'required',
			'class_id'            => 'required',
			'sid'				  => 'required|unique:students,sid',
			'first_name'          => 'required',
			'last_name'           => 'required',
			//'date_birth'          => 'required|date',
			'grade'               => 'required',
			//'email'               => 'required|email',
			//'address_street'      => 'required',
			//'address_city'        => 'required',
			//'address_province'    => 'required',
			//'address_country'     => 'required',
			//'address_postal_code' => 'required',
		]);

		$request['classroom_id'] = $request->input('class_id');
		$record = new Record;

		$record->fill($request->input());

		$record->save();


		$school = School::where('id',$request->input('school_id'))->first();
		$school->updateRecord()->save();

		$class = Classroom::where('id',$request->input('class_id'))->first();
		$class->updateRecord()->save();

		StudentAssoc::create([
			'student_id' => $record->id,
			'school_id'  => $request->input('school_id'),
			'class_id'   => $request->input('class_id'),
		]);

		$class = Classroom::find($request->input('class_id'));

		if ($class)
		{
			$class->updateRecord()->save();

			$survey = Campaign::where('class_id', '=', $class->id)->where('status', '=', 'Active')->first();

			if ($survey)
			{
				CampaignStudent::create([
					'campaign_id' => $survey->id,
					'student_id'  => $record->id,
					'secret'      => str_random(50),
					'status'      => 'NotStarted',
					'count_total' => count($survey->survey->questions)
				]);

				$survey->updateRecord();
			}
		}

		return \Response::json(['result' => true, 'msg' => trans('crud.success_added')]);
	}

	public function postStudentUpdate(Request $request, $class_id, $id)
	{
		$record = Record::find($id);

		if ($record)
		{
			$this->validate($request, [
				'sid'				  => 'required|unique:students,sid,'.$id,
				'first_name'          => 'required',
				'last_name'           => 'required',
				'grade'               => 'required',
			]);

			$record->fill($request->input());

			$record->save();

			\Session::flash('success', trans('crud.success_updated'));

			return \Response::json(['result' => true, 'msg' => trans('crud.success_updated'), 'url' => url('/m/classes/'.$class_id.'?s=1')]);
		}

		return \Response::json(['result' => false, 'msg' => trans('crud.not_found')]);
	}

	public function postImport(Request $request)
	{
		$files = \Input::file('files');

		if (!in_array($files[0]->getClientOriginalExtension(), ['xls', 'xlsx']))
		{
			return \Response::json(['result' => false, 'msg' => "Invalid file type, please upload a valid Excel file.", 'data' => [$files[0]->guessExtension()]]);			
		}
		else
		{
			$file = $files[0];

			$path = base_path() . "/storage/uploads/";

			$filename = str_random(10) . "." . $file->getClientOriginalExtension();

			$file->move($path, $filename);

			return \Response::json(['result' => true, 'msg' => "Uploaded successfully.", 'filename' => $filename]);
		}

		return \Response::json(['result' => false, 'msg' => "Error processing file, please try again."]);
	}

	public function postImportProcess()
	{
		$filename = \Input::get('filename');

		$path = base_path() . "/storage/uploads/";

		if (\File::exists($path.$filename))
		{
			$structure = [];

			$excel = \Excel::load($path.$filename, function($reader) use(&$structure)
			{
				$sheet = $reader->take(5)->get();

				$first = $sheet->first()->first();

				foreach ($first->toArray() as $key => $value)
				{
					$column = [
						'key'     => $key,
						'matched' => false,
					];

					foreach (Record::$importable as $field)
					{
						if (!empty($key) && $field == $key)
						{
							$column['matched'] = $key;
						}
					}

					$structure['columns'][] = $column;
				}

			    $sheet->first()->each(function($row) use(&$structure) {
					$structure['rows'][] = $row->toArray();			
				});
			});

			return \Response::json(['result' => true, 'msg' => "Success.", 'data' => $structure ]);
		}

		return \Response::json(['result' => false, 'msg' => "Error processing file, please try again."]);
	}

	public function postImportComplete()
	{
		$filename = \Input::get('filename');

		$path = base_path() . "/storage/uploads/";

		if (\File::exists($path.$filename))
		{
			$fields = \Input::get('fields');

			$required = [
				'student_id' => 'required',
				'first_name' => 'required',
				'last_name'  => 'required',
				'school'     => 'required',
			];

			foreach ($fields as $key => $match)
			{
				if (empty($match) || $match == '--' || $match == 'null')
				{
					return \Response::json(['result' => false, 'msg' => "Please resolve all unmatched columns before proceeding."]);
				}

				if ($match !='skip' && array_key_exists($match, $required))
				{
					unset($required[$match]);
				}
			}

			if (count($required) > 0)
			{
				return \Response::json(['result' => false, 'msg' => "The following required fields were not found: " . implode(",", array_keys($required)) ]);
			}

			$count = 0;

			$excel = \Excel::load($path.$filename, function($reader) use($fields, &$count)
			{
				$row_data = [
					'student_id'  => '',
					'first_name'  => '',
					'last_name'   => '',
					'date_birth'  => '',
					'school'      => '',
					'school_id'   => '',
					'grade'       => '',
					'classroom'   => '',
					'email'       => '',
					'street'      => '',
					'city'        => '',
					'province'    => '',
					'country'     => '',
					'postal_code' => '',
					'created_by'  => \Auth::user()->id,
				];

				$sheet = $reader->get();

			    $sheet->first()->each(function($row) use (&$row_data, $fields, &$count) {

			    	foreach ($fields as $key => $field)
			    	{
			    		if ($field != 'skip')
			    		{
							$row_data[$key] = $row->{$field};
						}
					}

					$school = School::where('name',$row_data['school'])->first();

					if ($school)
					{
						$row_data['school_id'] = $school->id;
					}

					$class = Classroom::where('title', $row_data['classroom'])->where('school_id',$school->id)->first();

					if (!$class) {
						$class = Classroom::create([
							'school_id' => $school->id,
							'title' => $row_data['classroom'],
							'grade' => $row_data['grade'],
							'status' => 'Active'
						]);
					}

					$row_data['classroom_id'] = $class->id;

					$student = Record::createFromImport($row_data);

					$assoc = StudentAssoc::where('student_id',$student->id)->where('class_id',$class->id)->first();

					if(!$assoc) {
						StudentAssoc::create([
							'student_id' => $student->id,
							'school_id' => $school->id,
							'class_id' => $class->id
						]);
					}

					$count++;
				});

				$student = Record::where('sid',$row_data['student_id'])->where('first_name',$row_data['first_name'])->first();
				$school = School::where('name',$row_data['school'])->first();
				$class = Classroom::where('title', $student->classroom)->where('school_id',$school->id)->first();
				$studentCount = StudentAssoc::where('class_id',$class->id)->count();

				$class->save();
			});

//			$this->updateSchools();

			\Session::flash('success', "Successfully imported $count students.");

			return \Response::json(['result' => true, 'msg' => "Success.", 'url' => url('m/schools') ]);
		}
	}

	private function updateSchools()
	{
		$list = Record::whereNotNull('school')->groupBy('school')->get();

		foreach ($list as $row)
		{
			$school = School::where(\DB::raw("LOWER(name)"), '=', strtolower($row->school))->first();

			if (empty($school))
			{
				$user = User::find($row->created_by);

				if ($user)
				{
					$school_board = $user->school_board->first();

					if ($school_board)
					{
						$school = School::create([
							'school_board_id' => $school_board->id,
							'name'            => $row->school,
						]);
					}
				}
			}

			if ($school)
			{
				$user = User::find($row->created_by);

				if ($user)
				{
					Record::where('school', '=', $row->school)->update(['school_id'=>$school->id]);

					$assoc = UserAssoc::where('school_id', '=', $school->id)->where('user_id', '=', $user->id)->count();

					if (empty($assoc))
					{
						UserAssoc::create([
							'school_id' => $school->id,
							'user_id'   => $user->id,
						]);
					}
				}

				$classrooms_list = Record::whereNotNull('classroom')->groupBy('classroom')->get();

				foreach ($classrooms_list as $r)
				{

					$classroom = Classroom::where('school_id', '=', $school->id)->where(\DB::raw("LOWER(title)"), '=', strtolower($r->classroom))->first();

					if (empty($classroom))
					{
						$classroom = Classroom::create([
							'school_id' => $school->id,
							'title'     => $r->classroom,
						]);
					} else {
						Record::where('classroom', '=', $r->classroom)->update(['classroom_id' => $classroom->id]);

						StudentAssoc::create([
							'student_id' => $r->id,
							'class_id' => $classroom->id,
						]);
					}
					$classroom->updateRecord()->save();
				}
				$school->updateRecord()->save();
			}

			$row->school = null;

			$row->save();
		}

	}

	public function postAddToClass($school_id, $class_id)
	{
		$ids = \Input::get('ids');

		$count = 0;

		foreach ($ids as $id)
		{
			$student = Record::find($id);

			if ($student)
			{
				$student->classroom_id = $class_id;
				$student->save();

				StudentAssoc::create([
					'student_id' => $student->id,
					'class_id'   => $class_id,
				]);

				$survey = Campaign::where('class_id', '=', $class_id)->where('status', '=', 'Active')->first();

				if ($survey)
				{
					CampaignStudent::create([
						'campaign_id' => $survey->id,
						'student_id'  => $student->id,
						'secret'      => str_random(50),
						'status'      => 'NotStarted',
						'count_total' => count($survey->survey->questions)
					]);

					$survey->updateRecord();
				}
			}

			$class = Classroom::find($class_id);

			if ($class)
			{
				$class->updateRecord()->save();
			}

			$count++;
		}

		\Session::flash('success', "Successfully added $count students to classroom: $class->title.");

		return \Response::json(['result' => true, 'msg' => "Success.", 'url' => url('m/students/'.$school_id) ]);
	}
}

