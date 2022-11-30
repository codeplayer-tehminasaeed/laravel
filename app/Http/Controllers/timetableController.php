<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Departments;
use App\Programs;
use App\Sections;
use App\User;
use App\Courses;
use App\teacherInfo;
use App\timetable;
use App\teacher_info;
use App\TeacherCourses;
use App\Rooms;
use App\lab;
use App\custom_timetable;


class timetableController extends Controller
{

  public function checkRandomDays($arr,$val){
    $res = 'false';
    if(!empty($arr)){
      foreach($arr as $el){
        if($el['day'] == $val){
          $res = 'true';
          return $res;
        }
      }
    }
    return $res;
  }
  
  public function checkSecRows(){
    $res = DB::table('sections')->count();
    return $res;
  }
  public function checkTotalLecInWeek(){
    $res = DB::table('teacher_courses')->sum('no_lectures');
    return $res;
  }
  public function checkTCID($arr,$id){
    $i = 0;
    if(!empty($arr)){
      foreach($arr as $el){
        if($el['tcid'] == $id){
          $i++;
        }
      }
    }
    return $i;
  }
  public function checkPerDayLec($arr,$val){
    $i = 0;
    if(!empty($arr)){
      foreach($arr as $el){
        if($el['day'] == $val){
          $i++;
        }
      }
    }
    return $i;
  }
  public function checklecPerClassPerDay($arr,$val,$secId){
    $i = 0;
    if(!empty($arr)){
      foreach($arr as $el){
        if($el['day'] == $val){
          if($el['secid'] == $secId){
            $i++;
          }
        }
      }
    }
    return $i;
  }
 public function checkLecNotRep($arr,$val,$tcId){
    $i = 0;
    if(!empty($arr)){
      foreach($arr as $el){
        if($el['day'] == $val){
          if($el['tcid'] == $tcId){
            $i++;
          }
        }
      }
    }
    return $i;
  }
 public function checkFreeSec($arr,$val,$secId,$slot){
    $i = 0;
    if(!empty($arr)){
      foreach($arr as $el){
        if($el['day'] == $val){
          if($el['secid'] == $secId && $el['slotid'] == $slot){
            $i++;
          }
        }
      }
    }
    return $i;
  }
 public function checkFreeTec($arr,$val,$tecId,$slot){
    $i = 0;
    if(!empty($arr)){
      foreach($arr as $el){
        if($el['day'] == $val){
          if($el['tecid'] == $tecId && $el['slotid'] == $slot){
            $i++;
          }
        }
      }
    }
    return $i;
  }
  public function checkCourseLecInWeek($arr,$tcId){
    $i = 0;
    if(!empty($arr)){
      foreach($arr as $el){
          if($el['tcid'] == $tcId){
            $i++;
        }
      }
    }
    return $i;
  }

public function getRandomSlot($secId){
    $slot = DB::table('slots')->count();
    
    $sec = DB::table('sections')
    ->where('section_id',$secId)
    ->get();

    if($sec[0]->semester%2 == 0){
      $i = true;
      while($i){
        $sl = rand(1,$slot);
        if($sl < 5)
          $i = false;
      }

    }else{
      $i = true;
      while($i){
        $sl = rand(1,$slot);
        if($sl > 2)
          $i = false;
      }
    }
  
  
    // dd($sl);

  return $sl;
}



  public function getRamdomRoomId($arr,$day,$slot,$sec_id,$tcid){

    $dep = DB::table('sections')
    ->join('programs', 'programs.program_id','=','sections.prg_id')
    ->join('departments','departments.department_id','=','programs.dep_id')
    ->where('sections.section_id',$sec_id)
    ->get();
    
    $totalLabs = DB::table('teacher_courses')
    ->join('courses', 'courses.course_id' ,'=','teacher_courses.course_id')
    ->join('programs', 'programs.program_id','=','courses.prg_id')
    ->join('departments','departments.department_id','=','programs.dep_id')
    ->where('departments.department_id',$dep[0]->dep_id)
    ->where('lab','yes')
    ->count();
    
    
    $prg = DB::table('sections')
    ->join('programs', 'programs.program_id','=','sections.prg_id')
    ->join('departments','departments.department_id','=','programs.dep_id')
    ->where('departments.department_id',$dep[0]->dep_id)
    ->count();
    
    $arrr = array('dep_name'=>$dep[0]->dep_name,'room'=>'','lab'=>'','id'=>'','lab_id'=>0);

    $noOfRooms =DB::table('rooms')
    ->where('rooms.block_id',$dep[0]->dep_id)
    ->count();
    if($prg > $noOfRooms){
      $arrr['room'] = $prg-$noOfRooms;
      return  $arrr;
    }
    $noOflab =DB::table('labs')
    ->where('labs.block_id',$dep[0]->dep_id)
    ->count();
    if(ceil($totalLabs/2) > $noOflab){
      $arrr['lab'] = ceil($totalLabs/1.5)-$noOflab;
      return  $arrr;
    }

    $room = DB::table('rooms')->inRandomOrder()
    ->where('rooms.block_id',$dep[0]->dep_id)   
    ->get();

    $lab = DB::table('labs')->inRandomOrder()
    ->where('labs.block_id',$dep[0]->dep_id)   
    ->get();
    // dd($lab);

    $lecType = DB::table('teacher_courses')
    ->where('teacher_course_id',$tcid)
    ->get();


    $i = 0;
    
    $arrr = array('dep_name'=>$dep[0]->dep_name,'lab'=>'','lab_id'=>0,'room'=>'','id'=>'');
    if($lecType[0]->lec_type == 'regular'){
      foreach($room as $r){
        if(!empty($arr)){
          foreach($arr as $el){
            if(($el['day'] != $day || $el['slotid'] != $slot) && $el['room_id'] != $r->room_id){
              $arrr['id'] = $r->room_id;
              return  $arrr;
            }
          }
        }else{
          $arrr['id'] = $r->room_id;
          return  $arrr;
        }
      }
    }else{
      foreach($lab as $l){
        if(!empty($arr)){
          foreach($arr as $el){
            if(($el['day'] != $day || $el['slotid'] != $slot) && $el['lab_id'] != $l->lab_id){
              $arrr['lab_id'] = $l->lab_id;
              return  $arrr;
            }
          }
        }else{
          $arrr['lab_id'] = $l->lab_id;
          return  $arrr;
        }
      }
    }
    dd($arrr);
    // return  $arrr;
  }



  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {

        $sections = DB::table('sections')
        ->join('programs' , 'sections.prg_id' , '=' , 'programs.program_id')
        ->join('departments' , 'programs.dep_id' , '=' , 'departments.department_id')
        ->paginate(8);

        return view("timetable.index")->with('sections',$sections);
}
  

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  { 
    timetable::query()->truncate();
    custom_timetable::query()->truncate();
    
    $timetable = [];
    $days = ['Monday','Tuesday','Wednesday','Thursday','Friday'];
    $secRows = $this->checkSecRows();
    $totalLecInWeek = $this->checkTotalLecInWeek();
    $totalLecPerDay = round(ceil($totalLecInWeek/5),0);
    $totalLecPerDay+=1;
    $lecPerClassPerDay = ceil($totalLecPerDay/$secRows);
    $i=1;
    while($i<=5){
      // echo count($timetable);
      $rDays = rand(0,4);
      if($this->checkRandomDays($timetable,$days[$rDays]) == 'false'){
        $teacherCoursesTable = DB::table('teacher_courses')->inRandomOrder()->get();
          foreach($teacherCoursesTable as $tc){
           if($this->checkTCID($timetable,$tc->teacher_course_id)<2){
            if($this->checkPerDayLec($timetable,$days[$rDays]) < $totalLecPerDay){
              if($this->checklecPerClassPerDay($timetable,$days[$rDays],$tc->sec_id) < $lecPerClassPerDay){
                if($this->checkLecNotRep($timetable,$days[$rDays],$tc->teacher_course_id) < 1){
                  if($this->checkCourseLecInWeek($timetable,$tc->teacher_course_id) < $tc->no_lectures){
                    do{
                      
                      $rSLot = $this->getRandomSlot($tc->sec_id);
                      $rr = 'false';
                      if($this->checkFreeSec($timetable,$days[$rDays],$tc->sec_id,$rSLot) == 0){
                        if($this->checkFreeTec($timetable,$days[$rDays],$tc->teacher_id,$rSLot) == 0){
                          $room_id = $this->getRamdomRoomId($timetable,$days[$rDays],$rSLot,$tc->sec_id,$tc->teacher_course_id);

                          if(!empty($room_id['room'])){
                            return back()->withError('Please add '.$room_id['room'].' More Room in '.$room_id['dep_name'].' Department');
                           }
                           if(!empty($room_id['lab'])){
                            return back()->withError('Please add '.$room_id['lab'].' More Labs in '.$room_id['dep_name'].' Department');
                           }
                          if($room_id['lab_id'] != 0){
                            $room_id['id']=0;
                          }
                          $tmpArr = ['day'=>$days[$rDays],'slotid'=>$rSLot,'tecid'=>$tc->teacher_id,'secid'=>$tc->sec_id,'tcid'=>$tc->teacher_course_id,'room_id'=>$room_id['id'],'type'=>'regular','lab_id'=>$room_id['lab_id'] ];
                            array_push($timetable,$tmpArr);

                          $rr = 'true';
                        }
                      }
                    }while($rr == 'false');
                    
                  }
                }
              }
            }}
          }
        $i++;
        }
      }
      
      // dd($timetable);

        foreach($timetable as $t){
          $time = new timetable;
          $time->t_course_id = $t['tcid'];
          $time->slot_id = $t['slotid'];
          $time->day = $t['day'];
          $time->sec_id = $t['secid'];
          $time->type = $t['type'];
          $time->room_id = $t['room_id'];
          $time->lab_id = $t['lab_id'];
          $time->save();
        }
        // dd("j");
        return back();
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    // // dd($id);
    // $timeTable = DB::table('timetables')
    // ->join('teacher_courses' , 'timetables.t_course_id' , '=' ,'teacher_courses.teacher_course_id')
    // ->join('courses','teacher_courses.course_id' , '=' ,'courses.course_id') 
    // ->join('slots','timetables.slot_id' , '=' ,'slots.slot_id') 
    // ->join('sections','timetables.sec_id' , '=' ,'sections.section_id')
    // ->join('programs','programs.program_id' , '=' ,'sections.prg_id')
    // ->join('teacher_infos','teacher_courses.teacher_id' , '=' ,'teacher_infos.teacher_info_id')
    // ->join('users','teacher_infos.teacher_id' , '=' ,'users.id')
    // ->paginate(8);

    // dd($timeTable);
    $data['timetable'] = DB::table('timetables')
    ->join('teacher_courses' , 'timetables.t_course_id' , '=' ,'teacher_courses.teacher_course_id')
    ->join('courses','teacher_courses.course_id' , '=' ,'courses.course_id') 
    ->join('slots','timetables.slot_id' , '=' ,'slots.slot_id') 
    ->join('sections','timetables.sec_id' , '=' ,'sections.section_id')
    ->join('programs','programs.program_id' , '=' ,'sections.prg_id')
    ->join('teacher_infos','teacher_courses.teacher_id' , '=' ,'teacher_infos.teacher_info_id')
    ->join('users','teacher_infos.teacher_id' , '=' ,'users.id')
    // ->join('rooms','rooms.room_id' , '=' ,'timetables.room_id')
    // ->join('departments','departments.department_id' , '=' ,'rooms.block_id')
    ->where('timetables.sec_id',$id)
    ->get();
    $data['rooms'] = array();
    $data['labs'] = array();
    foreach($data['timetable'] as $key => $rooms){
      if($rooms->room_id == 0){
        $labs = DB::table('labs')
        ->join('departments','departments.department_id' , '=' ,'labs.block_id')
        ->where('lab_id',$rooms->lab_id)
        ->get();
        // dd($labs);
        $temArray = ['lab_id'=>$labs[0]->lab_id, 'lab_name'=>$labs[0]->lab_name, 'block_name'=>$labs[0]->block_name ];
        array_push($data['labs'],$temArray);
      }else{
        $room= DB::table('rooms')
        ->join('departments','departments.department_id' , '=' ,'rooms.block_id')
        ->where('room_id',$rooms->room_id)
        ->get();
        $temp = ['room_id'=>$room[0]->room_id, 'room_no'=>$room[0]->room_no, 'block_name'=>$room[0]->block_name ];
        array_push($data['rooms'],$temp);
      }
      
    }
  //  dd($data);
    if(count($data['timetable']) != 0){
      $sec_id = $data['timetable'][0]->sec_id;
    
    $data['std']= DB::table('student_infos')
    ->where('student_infos.sec_id',$sec_id)
    ->first();
  }
    // dd($data['std']);
        $data['slotCount'] = DB::table('slots')->count();
        $data['slot'] = DB::table('slots')->get();
    // $data['sections'] = DB::table('teacher_info')
    // ->join('sections')

    // dd($data['timetable']);

    return view("timetable.show")->with('data',$data); 

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    DB::table('timetables')->where('sec_id', $id)->delete(); 
    return back()->withSuccess("Delete All timetable of selected Section");
  }
}
