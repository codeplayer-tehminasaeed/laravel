@extends('layouts.master')
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous">
</script>
@section('content')
<?php
    $days = array('Monday'=>'Monday','Tuesday'=>'Tuesday','Wednesday'=>'Wednesday','Thursday'=>'Thursday','Friday'=>'Friday',);
?>
  <h3 class="text-center">
    <button class="btn btn-warning pull-left" onclick="showBtn()">Edit</button>
    @if(count($data['timetable'])  !=  0)
    
    @if(!empty($data['std']))
    {{$data['timetable'][0]->batch_name}}
    @endif
    
    {{$data['timetable'][0]->prg_name}}-{{$data['timetable'][0]->sec_name}}  (Semester {{$data['timetable'][0]->semester}})
    @endif
  </h3>
 <?php
  $days = ['Monday'=>'Monday','Tuesday'=>'Tuesday','Wednesday'=>'Wednesday','Thursday'=>'Thursday','Friday'=>'Friday'];
 ?>


<div class="table-responsive">
  <table class="table table-bordered text-center">
      <thead class="thead-inverse">
        <tr>
          <th>Days</th>
        @foreach ($data['slot'] as $s)
          <th>Slot-{{$s->slot_no}}<br>({{$s->slot_time}})</th>
        @endforeach
          
        </tr>
      </thead>
      <tbody>
        {{-- <td>{{$x->day}}</td>
        <td>{{$x->slot_no}}</td>
        <td>{{$x->slot_time}}</td>
        <td>{{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}})</td> --}}

        
        <tr>
          <td>Monday</td>
          @if($data['slotCount']>=1)
          <td>
              <?php $a = 0; ?>
            @foreach($data['timetable'] as $x)
              @if($x->day == 'Monday')
                @if($x->slot_no == 1)
                <?php $a++ ?>
                <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                <div style="display:none" class="editSlot">
                    <select id="lec" class="form-control">
                      @foreach($data['custom'] as $z)
                        @if($z->slot_id == 1 && $z->day == 'Monday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                          <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                        @endif
                        @endforeach
                    </select>
                    <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                    <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                  </div>
                 <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">

                 <span class="text-primary">{{$x->name}} </span><br>
                <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                 {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
								<br>
								<?php $i= 0 ;?>
                 @foreach($data['rooms'] as $key => $r)
                    @if($x->room_id == $r['room_id'])
											@if($i == 0)                     
											{{$r['block_name']}}-{{$r['room_no']}}
											<?php $i++; ?>
											@endif
                    @endif
                  @endforeach
                  @if(count($data['labs'])>0)
                    @foreach($data['labs'] as $key => $l)
                      @if($x->lab_id == $l['lab_id'])
                        @if($i==0)                       <div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                      @endif
                    @endforeach
                  @endif
                
               
               
                @endif
              @endif
            @endforeach
            @if($a == 0)
            <div style="display:none" class="editSlot">
                <select id="lec" class="form-control">
                  @foreach($data['custom'] as $z)
                    @if($z->slot_id == 1 && $z->day == 'Monday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                      <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                    @endif
                    @endforeach
                </select>
                <input type="hidden" value="0">
                <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
              </div>
              <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
            @endif
          </div>
          </td>

          @endif
          @if($data['slotCount']>=2)
          <td>
              <?php $a = 0; ?>
            @foreach($data['timetable'] as $x)
              @if($x->day == 'Monday')
                @if($x->slot_no == 2)
                <?php  $a++ ?>
                <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                <div style="display:none" class="editSlot">
                    <select id="lec" class="form-control">
                      @foreach($data['custom'] as $z)
                        @if($z->slot_id == 2 && $z->day == 'Monday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                          <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                        @endif
                        @endforeach
                    </select>
                    <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                    <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                  </div>
                 <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">

                <span class="text-primary">{{$x->name}} </span><br>
                <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                 {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
								<br>
								<?php $i= 0 ;?>
								
               @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r['room_id'])
										@if($i == 0)                     
										{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     @endif
                  @endif
                @endforeach
                @if(count($data['labs'])>0)
                  @foreach($data['labs'] as $key => $l)
                    @if($x->lab_id == $l['lab_id'])
											@if($i==0)                       
											<div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                    @endif
                  @endforeach
                @endif
               </div>
                
               @endif
              @endif
            @endforeach
            @if($a==0)
           
            <div style="display:none" class="editSlot">
              <select id="lec" class="form-control">
                @foreach($data['custom'] as $z)
                  @if($z->slot_id == 2 && $z->day == 'Monday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                    <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                  @endif
                  @endforeach
              </select>
              <input type="hidden" value="0">
              <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
            </div>
            <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
            @endif
          </td>
          @endif
          @if($data['slotCount']>=3)
          <td>
              <?php $a = 0; ?>
            @foreach($data['timetable'] as $x)
              @if($x->day == 'Monday')
                @if($x->slot_no == 3)
                
                <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                <div style="display:none" class="editSlot">
                    <select id="lec" class="form-control">
                      @foreach($data['custom'] as $z)
                        @if($z->slot_id == 3 && $z->day == 'Monday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                          <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                        @endif
                        @endforeach
                    </select>
                    <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                    <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                  </div>
                 <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                <span class="text-primary">{{$x->name}} </span><br>
                <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                 {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
								<br>
								<?php $i= 0 ;?>
								
               @foreach($data['rooms'] as $key => $r)
                @if($x->room_id == $r['room_id'])
									@if($i == 0)                     
									{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     
									@endif
                @endif
              @endforeach
							@if(count($data['labs'])>0)
							<?php $i= 0 ;?>
                @foreach($data['labs'] as $key => $l)
                  @if($x->lab_id == $l['lab_id'])
										@if($i==0)                       
										<div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>  
										<?php $i++; ?>
										@endif
                  @endif
                @endforeach
              @endif
               </div>
               
                @endif
              @endif
            @endforeach
            @if($a==0)
               
                <div style="display:none" class="editSlot">
                  <select id="lec" class="form-control">
                    @foreach($data['custom'] as $z)
                      @if($z->slot_id == 3 && $z->day == 'Monday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                        <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                      @endif
                      @endforeach
                  </select>
                  <input type="hidden" value="0">
                  <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                </div>
                <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
                @endif
          </td>
          @endif
          @if($data['slotCount']>=4)
          <td>
              <?php $a = 0; ?>
            @foreach($data['timetable'] as $x)
              @if($x->day == 'Monday')
                @if($x->slot_no == 4)
                
               
                <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                <div style="display:none" class="editSlot">
                    <select id="lec" class="form-control">
                      @foreach($data['custom'] as $z)
                        @if($z->slot_id == 4 && $z->day == 'Monday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                          <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                        @endif
                        @endforeach
                    </select>
                    <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                    <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                  </div>
                 <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                <span class="text-primary">{{$x->name}} </span><br>
                <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                 {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
								<br>
								<?php $i= 0 ;?>
								
               @foreach($data['rooms'] as $key => $r)
                @if($x->room_id == $r['room_id'])
									@if($i == 0)                     
									{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                    
									@endif
                @endif
              @endforeach
              @if(count($data['labs'])>0)
                @foreach($data['labs'] as $key => $l)
                  @if($x->lab_id == $l['lab_id'])
										@if($i==0)                       
										<div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                  @endif
                @endforeach
              @endif
               </div>
               
                @endif
              @endif
            @endforeach
            @if($a==0)
                <div style="display:none" class="editSlot">
                  <select id="lec" class="form-control">
                    @foreach($data['custom'] as $z)
                      @if($z->slot_id == 4 && $z->day == 'Monday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                        <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                      @endif
                      @endforeach
                  </select>
                  <input type="hidden" value="0">
                  <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                </div>
                <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
                @endif
          </td>
          @endif
          @if($data['slotCount']>=5)
          <td>
              <?php $a = 0; ?>
            
            @foreach($data['timetable'] as $x)
              @if($x->day == 'Monday')
                @if($x->slot_no == 5)
               
                <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                <div style="display:none" class="editSlot">
                    <select id="lec" class="form-control">
                      @foreach($data['custom'] as $z)
                        @if($z->slot_id == 5 && $z->day == 'Monday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                          <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                        @endif
                        @endforeach
                    </select>
                    <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                    <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                  </div>
                 <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                <span class="text-primary">{{$x->name}} </span><br>
                <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                 {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
								<br>
								<?php $i= 0 ;?>
								
               @foreach($data['rooms'] as $key => $r)
                @if($x->room_id == $r['room_id'])
									@if($i == 0)                     
									{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     
									@endif
                @endif
              @endforeach
              @if(count($data['labs'])>0)
                @foreach($data['labs'] as $key => $l)
                  @if($x->lab_id == $l['lab_id'])
										@if($i==0)                       
										<div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                  @endif
                @endforeach
              @endif
               </div>
               
                @endif
              @endif
            @endforeach
            @if($a==0)
            
            <div style="display:none" class="editSlot">
              <select id="lec" class="form-control">
                @foreach($data['custom'] as $z)
                  @if($z->slot_id == 5 && $z->day == 'Monday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                    <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                  @endif
                  @endforeach
              </select>
              <input type="hidden" value="0">
              <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
            </div>
            <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
            @endif
          </td>
          @endif
          @if($data['slotCount']>=6)
          <td>
              <?php $a = 0; ?>
            @foreach($data['timetable'] as $x)
              @if($x->day == 'Monday')
                @if($x->slot_no == 6)
               
                <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                <div style="display:none" class="editSlot">
                    <select id="lec" class="form-control">
                      @foreach($data['custom'] as $z)
                        @if($z->slot_id == 6 && $z->day == 'Monday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                          <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                        @endif
                        @endforeach
                    </select>
                    <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                    <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                  </div>
                 <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                <span class="text-primary">{{$x->name}} </span><br>
                <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                 {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
								<br>
								<?php $i= 0 ;?>
								
               @foreach($data['rooms'] as $key => $r)
                @if($x->room_id == $r['room_id'])
									@if($i == 0)                     
									{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     
									@endif
                @endif
              @endforeach
              @if(count($data['labs'])>0)
                @foreach($data['labs'] as $key => $l)
                  @if($x->lab_id == $l['lab_id'])
										@if($i==0)                       
										<div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                  @endif
                @endforeach
              @endif
               </div>
              
                @endif
              @endif
            @endforeach
            @if($a==0)
                <div style="display:none" class="editSlot">
                  <select id="lec" class="form-control">
                    @foreach($data['custom'] as $z)
                      @if($z->slot_id == 6 && $z->day == 'Monday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                        <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                      @endif
                      @endforeach
                  </select>
                  <input type="hidden" value="0">
                  <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                </div>
                <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
                @endif
          </td>
          @endif
          @if($data['slotCount']>=7)
          <td>
              <?php $a = 0; ?>
            @foreach($data['timetable'] as $x)
              @if($x->day == 'Monday')
                @if($x->slot_no == 7)
               
                <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                <div style="display:none" class="editSlot">
                    <select id="lec" class="form-control">
                      @foreach($data['custom'] as $z)
                        @if($z->slot_id == 7 && $z->day == 'Monday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                          <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                        @endif
                        @endforeach
                    </select>
                    <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                    <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                  </div>
                 <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                <span class="text-primary">{{$x->name}} </span><br>
                <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                 {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
								<br>
								<?php $i= 0 ;?>
								
               @foreach($data['rooms'] as $key => $r)
                @if($x->room_id == $r['room_id'])
									@if($i == 0)                     
									{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     
									@endif
                @endif
              @endforeach
              @if(count($data['labs'])>0)
                @foreach($data['labs'] as $key => $l)
                  @if($x->lab_id == $l['lab_id'])
										@if($i==0)                       
										<div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                  @endif
                @endforeach
              @endif
               </div>
              
                @endif
              @endif
            @endforeach
            @if($a==0)
                <div style="display:none" class="editSlot">
                  <select id="lec" class="form-control">
                    @foreach($data['custom'] as $z)
                      @if($z->slot_id == 7 && $z->day == 'Monday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                        <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                      @endif
                      @endforeach
                  </select>
                  <input type="hidden" value="0">
                  <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                </div>
                <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
                @endif
          </td>
          @endif
          @if($data['slotCount']>=8)
          <td>
              <?php $a = 0; ?>
            @foreach($data['timetable'] as $x)
              @if($x->day == 'Monday')
                @if($x->slot_no == 8)
               
                <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                <div style="display:none" class="editSlot">
                    <select id="lec" class="form-control">
                      @foreach($data['custom'] as $z)
                        @if($z->slot_id == 8 && $z->day == 'Monday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                          <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                        @endif
                        @endforeach
                    </select>
                    <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                    <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                  </div>
                 <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                <span class="text-primary">{{$x->name}} </span><br>
                <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                 {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
								<br>
								<?php $i= 0 ;?>
								
               @foreach($data['rooms'] as $key => $r)
                @if($x->room_id == $r['room_id'])
									@if($i == 0)                     
									{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     
									@endif
                @endif
              @endforeach
              @if(count($data['labs'])>0)
                @foreach($data['labs'] as $key => $l)
                  @if($x->lab_id == $l['lab_id'])
										@if($i==0)                       
										<div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                  @endif
                @endforeach
              @endif
               </div>
               
                @endif
              @endif
            @endforeach
            @if($a==0)
                <div style="display:none" class="editSlot">
                  <select id="lec" class="form-control">
                    @foreach($data['custom'] as $z)
                      @if($z->slot_id == 8 && $z->day == 'Monday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                        <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                      @endif
                      @endforeach
                  </select>
                  <input type="hidden" value="0">
                  <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                </div>
                <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
                @endif
          </td>
          @endif
          
          
        </tr>
         <tr>
          <td>Tuesday</td>
         
          @if($data['slotCount']>=1)
          <td>
              <?php $a = 0; ?>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Tuesday')
                  @if($x->slot_no == 1)

                  <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
              <div style="display:none" class="editSlot">
                  <select id="lec" class="form-control">
                    @foreach($data['custom'] as $z)
                      @if($z->slot_id == 1 && $z->day == 'Tuesday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                        <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                      @endif
                      @endforeach
                  </select>
                  <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                  <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                </div>


               <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                  <span class="text-primary">{{$x->name}} </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
									<br>
								<?php $i= 0 ;?>
									
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r['room_id'])
										@if($i == 0)                     
										{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     @endif
                  @endif
                @endforeach
                @if(count($data['labs'])>0)
                  @foreach($data['labs'] as $key => $l)
                    @if($x->lab_id == $l['lab_id'])
											@if($i==0)                       
											<div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                    @endif
                  @endforeach
                @endif
               </div>
              
                  @endif
                @endif
              @endforeach
              @if($a==0)
                <div style="display:none" class="editSlot">
                  <select id="lec" class="form-control">
                    @foreach($data['custom'] as $z)
                      @if($z->slot_id == 1 && $z->day == 'Tuesday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                        <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                      @endif
                      @endforeach
                  </select>
                  <input type="hidden" value="0">
                  <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                </div>
                <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
                  @endif
            </td>
            @endif
          @if($data['slotCount']>=2)
            <td>
                <?php $a = 0; ?>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Tuesday')
                  @if($x->slot_no == 2)
                  
                <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                <div style="display:none" class="editSlot">
                    <select id="lec" class="form-control">
                      @foreach($data['custom'] as $z)
                        @if($z->slot_id == 2 && $z->day == 'Tuesday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                          <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                        @endif
                        @endforeach
                    </select>
                    <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                    <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                  </div>
                 <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                  <span class="text-primary">{{$x->name}} </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
									<br>
								<?php $i= 0 ;?>
									
                   @foreach($data['rooms'] as $key => $r)
                    @if($x->room_id == $r['room_id'])
											@if($i == 0)                     
											{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     @endif
                    @endif
                  @endforeach
                  @if(count($data['labs'])>0)
                    @foreach($data['labs'] as $key => $l)
                      @if($x->lab_id == $l['lab_id'])
												@if($i==0)                       
												<div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                      @endif
                    @endforeach
                  @endif
                 </div>
                
                  @endif
                @endif
              @endforeach
              @if($a==0)
              <div style="display:none" class="editSlot">
                <select id="lec" class="form-control">
                  @foreach($data['custom'] as $z)
                    @if($z->slot_id == 2 && $z->day == 'Tuesday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                      <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                    @endif
                    @endforeach
                </select>
                <input type="hidden" value="0">
                <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
              </div>
              <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
                @endif
            </td>
            @endif
          @if($data['slotCount']>=3)
            <td>
                <?php $a = 0; ?>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Tuesday')
                  @if($x->slot_no == 3)
                   
                <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                <div style="display:none" class="editSlot">
                    <select id="lec" class="form-control">
                      @foreach($data['custom'] as $z)
                        @if($z->slot_id == 3 && $z->day == 'Tuesday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                          <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                        @endif
                        @endforeach
                    </select>
                    <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                    <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                  </div>
                 <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                  <span class="text-primary">{{$x->name}} </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r['room_id'])
										@if($i == 0)                    
										 {{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     @endif
                  @endif
                @endforeach
                @if(count($data['labs'])>0)
                  @foreach($data['labs'] as $key => $l)
                    @if($x->lab_id == $l['lab_id'])
                      @if($i==0)                       <div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                    @endif
                  @endforeach
                @endif
                 </div>

                  @endif
                @endif
              @endforeach
              @if($a==0)
              <div style="display:none" class="editSlot">
                <select id="lec" class="form-control">
                  @foreach($data['custom'] as $z)
                    @if($z->slot_id == 3 && $z->day == 'Tuesday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                      <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                    @endif
                    @endforeach
                </select>
                <input type="hidden" value="0">
                <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
              </div>
              <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
                @endif
            </td>
            @endif
          @if($data['slotCount']>=4)
            <td>
                <?php $a = 0; ?>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Tuesday')
                  @if($x->slot_no == 4)
                   
                <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                <div style="display:none" class="editSlot">
                    <select id="lec" class="form-control">
                      @foreach($data['custom'] as $z)
                        @if($z->slot_id == 4 && $z->day == 'Tuesday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                          <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                        @endif
                        @endforeach
                    </select>
                    <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                    <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                  </div>
                 <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                  <span class="text-primary">{{$x->name}} </span><br>
                  
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								 </div>
								<?php $i= 0 ;?>
								 
                @foreach($data['rooms'] as $key => $r)
                 @if($x->room_id == $r['room_id'])
									 @if($i == 0)                     
									 {{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     @endif
                 @endif
               @endforeach
               @if(count($data['labs'])>0)
                 @foreach($data['labs'] as $key => $l)
                   @if($x->lab_id == $l['lab_id'])
										 @if($i==0)                       
										 <div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                   @endif
                 @endforeach
               @endif
               
                  @endif
                @endif
              @endforeach
              @if($a==0)
              <div style="display:none" class="editSlot">
                <select id="lec" class="form-control">
                  @foreach($data['custom'] as $z)
                    @if($z->slot_id == 4 && $z->day == 'Tuesday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                      <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                    @endif
                    @endforeach
                </select>
                <input type="hidden" value="0">
                <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
              </div>
              <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
                 @endif
            </td>
            @endif
          @if($data['slotCount']>=5)
            <td>
                <?php $a = 0; ?>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Tuesday')
                  @if($x->slot_no == 5)
                    
                <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                <div style="display:none" class="editSlot">
                    <select id="lec" class="form-control">
                      @foreach($data['custom'] as $z)
                        @if($z->slot_id == 5 && $z->day == 'Tuesday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                          <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                        @endif
                        @endforeach
                    </select>
                    <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                    <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                  </div>
                 <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                   <span class="text-primary">{{$x->name}} </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                    @if($x->room_id == $r['room_id'])
											@if($i == 0)                     
											{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     @endif
                    @endif
                 @endforeach
                @if(count($data['labs'])>0)
                  @foreach($data['labs'] as $key => $l)
                    @if($x->lab_id == $l['lab_id'])
											@if($i==0)                       '
											<div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                    @endif
                  @endforeach
                @endif
                @endif
                
                @endif
              @endforeach
              @if($a==0)
                <div style="display:none" class="editSlot">
                  <select id="lec" class="form-control">
                    @foreach($data['custom'] as $z)
                      @if($z->slot_id == 5 && $z->day == 'Tuesday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                        <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                      @endif
                      @endforeach
                  </select>
                  <input type="hidden" value="0">
                  <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                </div>
                <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
                  @endif
            </td>
            @endif
          @if($data['slotCount']>=6)
            <td>
                <?php $a = 0; ?>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Tuesday')
                  @if($x->slot_no == 6)
                   
                <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                <div style="display:none" class="editSlot">
                    <select id="lec" class="form-control">
                      @foreach($data['custom'] as $z)
                        @if($z->slot_id == 6 && $z->day == 'Tuesday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                          <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                        @endif
                        @endforeach
                    </select>
                    <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                    <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                  </div>
                 <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                  <span class="text-primary">{{$x->name}} </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
									<br>
								<?php $i= 0 ;?>
									
                 
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r['room_id'])
										@if($i == 0)                     
										{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     @endif
                  @endif
                @endforeach
                @if(count($data['labs'])>0)
                  @foreach($data['labs'] as $key => $l)
                    @if($x->lab_id == $l['lab_id'])
											@if($i==0)                       
											<div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                    @endif
                  @endforeach
                @endif
                 </div>
                
                @endif
                @endif
              @endforeach
              @if($a==0)
              <div style="display:none" class="editSlot">
                <select id="lec" class="form-control">
                  @foreach($data['custom'] as $z)
                    @if($z->slot_id == 6 && $z->day == 'Tuesday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                      <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                    @endif
                    @endforeach
                </select>
                <input type="hidden" value="0">
                <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
              </div>
              <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
                @endif
            </td>
            @endif
          @if($data['slotCount']>=7)
            <td>
                <?php $a = 0; ?>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Tuesday')
                  @if($x->slot_no == 7)
                   
                <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                <div style="display:none" class="editSlot">
                    <select id="lec" class="form-control">
                      @foreach($data['custom'] as $z)
                        @if($z->slot_id == 7 && $z->day == 'Tuesday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                          <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                        @endif
                        @endforeach
                    </select>
                    <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                    <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                  </div>
                 <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                  <span class="text-primary">{{$x->name}} </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
									<br>
								<?php $i= 0 ;?>
									
                 
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r['room_id'])
										@if($i == 0)                     
										{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     @endif
                  @endif
                @endforeach
                @if(count($data['labs'])>0)
                  @foreach($data['labs'] as $key => $l)
                    @if($x->lab_id == $l['lab_id'])
											@if($i==0)                       
											<div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                    @endif
                  @endforeach
                @endif
                 </div>
                
                @endif
                @endif
              @endforeach
              @if($a==0)
                
              <div style="display:none" class="editSlot">
                <select id="lec" class="form-control">
                  @foreach($data['custom'] as $z)
                    @if($z->slot_id == 7 && $z->day == 'Tuesday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                      <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                    @endif
                    @endforeach
                </select>
                <input type="hidden" value="0">
                <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
              </div>
              <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
                @endif
            </td>
            @endif
          @if($data['slotCount']>=8)
            <td>
                <?php $a = 0; ?>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Tuesday')
                  @if($x->slot_no == 8)
                   
                <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                <div style="display:none" class="editSlot">
                    <select id="lec" class="form-control">
                      @foreach($data['custom'] as $z)
                        @if($z->slot_id == 8 && $z->day == 'Tuesday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                          <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                        @endif
                        @endforeach
                    </select>
                    <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                    <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                  </div>
                 <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                  <span class="text-primary">{{$x->name}} </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
									<br>
								<?php $i= 0 ;?>
									
                 
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r['room_id'])
										@if($i == 0)                     
										{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     @endif
                  @endif
                @endforeach
                @if(count($data['labs'])>0)
                  @foreach($data['labs'] as $key => $l)
                    @if($x->lab_id == $l['lab_id'])
											@if($i==0)                       
											<div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                    @endif
                  @endforeach
                @endif
                 </div>
                
                @endif
                @endif
              @endforeach
              @if($a==0)
                
              <div style="display:none" class="editSlot">
                <select id="lec" class="form-control">
                  @foreach($data['custom'] as $z)
                    @if($z->slot_id == 8 && $z->day == 'Tuesday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                      <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                    @endif
                    @endforeach
                </select>
                <input type="hidden" value="0">
                <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
              </div>
              <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
                @endif
            </td>
            @endif
          
        </tr>
         <tr>
          <td>Wednesday</td>
          
          @if($data['slotCount']>=1)

          <td>
              <?php $a = 0; ?>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Wednesday')
                  @if($x->slot_no == 1)
                 
                  <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                  <div style="display:none" class="editSlot">
                      <select id="lec" class="form-control">
                        @foreach($data['custom'] as $z)
                          @if($z->slot_id == 1 && $z->day == 'Wednesday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                            <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                          @endif
                          @endforeach
                      </select>
                      <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                      <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                    </div>
                   <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                  <span class="text-primary">{{$x->name}} </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                 
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r['room_id'])
										@if($i == 0)                     
										{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     @endif
                  @endif
                @endforeach
                @if(count($data['labs'])>0)
                  @foreach($data['labs'] as $key => $l)
                    @if($x->lab_id == $l['lab_id'])
											@if($i==0)                       
											<div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                    @endif
                  @endforeach
                @endif
               </div>

                @endif
                @endif
              @endforeach
              
              @if($a==0)
                
              <div style="display:none" class="editSlot">
                <select id="lec" class="form-control">
                  @foreach($data['custom'] as $z)
                    @if($z->slot_id == 1 && $z->day == 'Wednesday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                      <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                    @endif
                    @endforeach
                </select>
                <input type="hidden" value="0">
                <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
              </div>
              <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
             
                @endif
            </td>
            @endif
          @if($data['slotCount']>=2)
            <td>
                <?php $a = 0; ?>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Wednesday')
                  @if($x->slot_no == 2)
                  <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                  <div style="display:none" class="editSlot">
                      <select id="lec" class="form-control">
                        @foreach($data['custom'] as $z)
                          @if($z->slot_id == 2 && $z->day == 'Wednesday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                            <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                          @endif
                          @endforeach
                      </select>
                      <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                      <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                    </div>
                   <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                  <span class="text-primary">{{$x->name}} </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r['room_id'])
										@if($i == 0)                     
										{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     @endif
                  @endif
                @endforeach
                @if(count($data['labs'])>0)
                  @foreach($data['labs'] as $key => $l)
                    @if($x->lab_id == $l['lab_id'])
											@if($i==0)                       
											<div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                    @endif
                  @endforeach
                @endif
                 </div>
                 
                @endif
                @endif
              @endforeach
              @if($a==0)
                
                <div style="display:none" class="editSlot">
                  <select id="lec" class="form-control">
                    @foreach($data['custom'] as $z)
                      @if($z->slot_id == 2 && $z->day == 'Wednesday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                        <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                      @endif
                      @endforeach
                  </select>
                  <input type="hidden" value="0">
                  <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                </div>
                <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
                  @endif
            </td>
            @endif
          @if($data['slotCount']>=3)
            <td>
                <?php $a = 0; ?>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Wednesday')
                  @if($x->slot_no == 3)
                  <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                  <div style="display:none" class="editSlot">
                      <select id="lec" class="form-control">
                        @foreach($data['custom'] as $z)
                          @if($z->slot_id == 3 && $z->day == 'Wednesday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                            <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                          @endif
                          @endforeach
                      </select>
                      <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                      <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                    </div>
                   <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                  <span class="text-primary">{{$x->name}} </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r['room_id'])
										@if($i == 0)                     
										{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     @endif
                  @endif
                @endforeach
                @if(count($data['labs'])>0)
                  @foreach($data['labs'] as $key => $l)
                    @if($x->lab_id == $l['lab_id'])
											@if($i==0)                       
											<div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                    @endif
                  @endforeach
                @endif
                 </div>
                 
                @endif
                @endif
              @endforeach
              @if($a==0)
                
                <div style="display:none" class="editSlot">
                  <select id="lec" class="form-control">
                    @foreach($data['custom'] as $z)
                      @if($z->slot_id == 3 && $z->day == 'Wednesday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                        <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                      @endif
                      @endforeach
                  </select>
                  <input type="hidden" value="0">
                  <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                </div>
                <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
                  @endif
            </td>
            @endif
          @if($data['slotCount']>=4)
            <td>
                <?php $a = 0; ?>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Wednesday')
                  @if($x->slot_no == 4)
                  <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                  <div style="display:none" class="editSlot">
                      <select id="lec" class="form-control">
                        @foreach($data['custom'] as $z)
                          @if($z->slot_id == 4 && $z->day == 'Wednesday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                            <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                          @endif
                          @endforeach
                      </select>
                      <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                      <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                    </div>
                   <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                  <span class="text-primary">{{$x->name}} </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r['room_id'])
										@if($i == 0)                     
										{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     @endif
                  @endif
                @endforeach
                @if(count($data['labs'])>0)
                  @foreach($data['labs'] as $key => $l)
                    @if($x->lab_id == $l['lab_id'])
											@if($i==0)                       
											<div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                    @endif
                  @endforeach
                @endif
                 </div>
                
                @endif
                @endif
              @endforeach
              @if($a==0)
                
              <div style="display:none" class="editSlot">
                <select id="lec" class="form-control">
                  @foreach($data['custom'] as $z)
                    @if($z->slot_id == 4 && $z->day == 'Wednesday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                      <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                    @endif
                    @endforeach
                </select>
                <input type="hidden" value="0">
                <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
              </div>
              <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
                @endif
            </td>
            @endif
          @if($data['slotCount']>=5)
            <td>
                <?php $a = 0; ?>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Wednesday')
                  @if($x->slot_no == 5)
                  <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                  <div style="display:none" class="editSlot">
                      <select id="lec" class="form-control">
                        @foreach($data['custom'] as $z)
                          @if($z->slot_id == 5 && $z->day == 'Wednesday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                            <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                          @endif
                          @endforeach
                      </select>
                      <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                      <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                    </div>
                   <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                  <span class="text-primary">{{$x->name}} </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r['room_id'])
										@if($i == 0)                     
										{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     @endif
                  @endif
                @endforeach
                @if(count($data['labs'])>0)
                  @foreach($data['labs'] as $key => $l)
                    @if($x->lab_id == $l['lab_id'])
											@if($i==0)                       
											<div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                    @endif
                  @endforeach
                @endif
                 </div>
                 
                @endif
                @endif
              @endforeach
              @if($a==0)
                
                <div style="display:none" class="editSlot">
                  <select id="lec" class="form-control">
                    @foreach($data['custom'] as $z)
                      @if($z->slot_id == 5 && $z->day == 'Wednesday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                        <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                      @endif
                      @endforeach
                  </select>
                  <input type="hidden" value="0">
                  <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                </div>
                <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
                  @endif
            </td>
            @endif
          @if($data['slotCount']>=6)
            <td>
                <?php $a = 0; ?>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Wednesday')
                  @if($x->slot_no == 6)
                  <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                  <div style="display:none" class="editSlot">
                      <select id="lec" class="form-control">
                        @foreach($data['custom'] as $z)
                          @if($z->slot_id == 6 && $z->day == 'Wednesday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                            <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                          @endif
                          @endforeach
                      </select>
                      <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                      <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                    </div>
                   <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                  <span class="text-primary">{{$x->name}} </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r['room_id'])
										@if($i == 0)                     
										{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     @endif
                  @endif
                @endforeach
                @if(count($data['labs'])>0)
                  @foreach($data['labs'] as $key => $l)
                    @if($x->lab_id == $l['lab_id'])
											@if($i==0)                       
											<div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                    @endif
                  @endforeach
                @endif
                 </div>
                 
                @endif
                @endif
              @endforeach
              @if($a==0)
                
                <div style="display:none" class="editSlot">
                  <select id="lec" class="form-control">
                    @foreach($data['custom'] as $z)
                      @if($z->slot_id == 6 && $z->day == 'Wednesday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                        <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                      @endif
                      @endforeach
                  </select>
                  <input type="hidden" value="0">
                  <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                </div>
                <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
                  @endif
            </td>
            @endif
          @if($data['slotCount']>=7)
            <td>
                <?php $a = 0; ?>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Wednesday')
                  @if($x->slot_no == 7)
                  <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                  <div style="display:none" class="editSlot">
                      <select id="lec" class="form-control">
                        @foreach($data['custom'] as $z)
                          @if($z->slot_id == 7 && $z->day == 'Wednesday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                            <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                          @endif
                          @endforeach
                      </select>
                      <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                      <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                    </div>
                   <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                  <span class="text-primary">{{$x->name}} </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r['room_id'])
										@if($i == 0)                     
										{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     @endif
                  @endif
                @endforeach
                @if(count($data['labs'])>0)
                  @foreach($data['labs'] as $key => $l)
                    @if($x->lab_id == $l['lab_id'])
											@if($i==0)                       
											<div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                    @endif
                  @endforeach
                @endif
                 </div>
                 
                @endif
                @endif
              @endforeach
              @if($a==0)
                
                <div style="display:none" class="editSlot">
                  <select id="lec" class="form-control">
                    @foreach($data['custom'] as $z)
                      @if($z->slot_id == 7 && $z->day == 'Wednesday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                        <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                      @endif
                      @endforeach
                  </select>
                  <input type="hidden" value="0">
                  <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                </div>
                <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
                  @endif
            </td>
            @endif
          @if($data['slotCount']>=8)
            <td>
                <?php $a = 0; ?>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Wednesday')
                  @if($x->slot_no == 8)
                  <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                  <div style="display:none" class="editSlot">
                      <select id="lec" class="form-control">
                        @foreach($data['custom'] as $z)
                          @if($z->slot_id == 8 && $z->day == 'Wednesday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                            <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                          @endif
                          @endforeach
                      </select>
                      <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                      <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                    </div>
                   <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                  <span class="text-primary">{{$x->name}} </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r['room_id'])
										@if($i == 0)                     
										{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     @endif
                  @endif
                @endforeach
                @if(count($data['labs'])>0)
                  @foreach($data['labs'] as $key => $l)
                    @if($x->lab_id == $l['lab_id'])
											@if($i==0)                       
											<div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                    @endif
                  @endforeach
                @endif
                 </div>
                 
                @endif
                @endif
              @endforeach
              @if($a==0)
                
                <div style="display:none" class="editSlot">
                  <select id="lec" class="form-control">
                    @foreach($data['custom'] as $z)
                      @if($z->slot_id == 8 && $z->day == 'Wednesday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                        <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                      @endif
                      @endforeach
                  </select>
                  <input type="hidden" value="0">
                  <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                </div>
                <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
                  @endif
            </td>
            @endif
          
        </tr>
         <tr>
          <td>Thursday</td>
          
          @if($data['slotCount']>=1)
          <td>
            
              <?php $a = 0; ?>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Thursday')
                  @if($x->slot_no == 1)
                  <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                  <div style="display:none" class="editSlot">
                      <select id="lec" class="form-control">
                        @foreach($data['custom'] as $z)
                          @if($z->slot_id == 1 && $z->day == 'Thursday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                            <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                          @endif
                          @endforeach
                      </select>
                      <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                      <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                    </div>
                   <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                  <span class="text-primary">{{$x->name}} </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r['room_id'])
										@if($i == 0)                     
										{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     @endif
                  @endif
                @endforeach
                @if(count($data['labs'])>0)
                  @foreach($data['labs'] as $key => $l)
                    @if($x->lab_id == $l['lab_id'])
											@if($i==0)                       
											<div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                    @endif
                  @endforeach
                @endif
               </div>

              
                @endif
                @endif
              @endforeach
              @if($a==0)
                
              <div style="display:none" class="editSlot">
                <select id="lec" class="form-control">
                  @foreach($data['custom'] as $z)
                    @if($z->slot_id == 1 && $z->day == 'Thursday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                      <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                    @endif
                    @endforeach
                </select>
                <input type="hidden" value="0">
                <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
              </div>
              <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>

                @endif
            </td>
            @endif
          @if($data['slotCount']>=2)
            <td>
                <?php $a = 0; ?>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Thursday')
                  @if($x->slot_no == 2)
                  <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                  <div style="display:none" class="editSlot">
                      <select id="lec" class="form-control">
                        @foreach($data['custom'] as $z)
                          @if($z->slot_id == 2 && $z->day == 'Thursday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                            <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                          @endif
                          @endforeach
                      </select>
                      <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                      <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                    </div>
                   <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                  <span class="text-primary">{{$x->name}} </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
									<?php $i= 0 ;?>
 
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r['room_id'])
                    @if($i == 0)
                    {{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>
                    @endif
                  @endif
                @endforeach
                @if(count($data['labs'])>0)
                  @foreach($data['labs'] as $key => $l)
                    @if($x->lab_id == $l['lab_id'])
											@if($i==0)                       
											<div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                    @endif
                  @endforeach
                @endif
                 </div>
                 
               
                @endif
                @endif
              @endforeach
              @if($a==0)
               
               <div style="display:none" class="editSlot">
                 <select id="lec" class="form-control">
                   @foreach($data['custom'] as $z)
                     @if($z->slot_id == 2 && $z->day == 'Thursday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                       <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                     @endif
                     @endforeach
                 </select>
                 <input type="hidden" value="0">
                 <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
               </div>
               <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
                  @endif
            </td>
            @endif
          @if($data['slotCount']>=3)
            <td>
                <?php $a = 0; ?>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Thursday')
                  @if($x->slot_no == 3)
                  <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                  <div style="display:none" class="editSlot">
                      <select id="lec" class="form-control">
                        @foreach($data['custom'] as $z)
                          @if($z->slot_id == 3 && $z->day == 'Thursday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                            <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                          @endif
                          @endforeach
                      </select>
                      <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                      <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                    </div>
                   <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                  <span class="text-primary">{{$x->name}} </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r['room_id'])
										@if($i == 0)                     
										{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     @endif
                  @endif
                @endforeach
                @if(count($data['labs'])>0)
                  @foreach($data['labs'] as $key => $l)
                    @if($x->lab_id == $l['lab_id'])
											@if($i==0)                       
											<div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                    @endif
                  @endforeach
                @endif
                 </div>

                 
                @endif
                @endif
              @endforeach
              @if($a==0)
                 
                 <div style="display:none" class="editSlot">
                   <select id="lec" class="form-control">
                     @foreach($data['custom'] as $z)
                       @if($z->slot_id == 3 && $z->day == 'Thursday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                         <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                       @endif
                       @endforeach
                   </select>
                   <input type="hidden" value="0">
                   <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                 </div>
                 <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
                  @endif
            </td>
            @endif
          @if($data['slotCount']>=4)
            <td>
                <?php $a = 0; ?>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Thursday')
                  @if($x->slot_no == 4)
                  <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                  <div style="display:none" class="editSlot">
                      <select id="lec" class="form-control">
                        @foreach($data['custom'] as $z)
                          @if($z->slot_id == 4 && $z->day == 'Thursday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                            <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                          @endif
                          @endforeach
                      </select>
                      <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                      <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                    </div>
                   <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                  <span class="text-primary">{{$x->name}} </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                  @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r['room_id'])
										@if($i == 0)                     
										{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     @endif
                  @endif
                @endforeach
                @if(count($data['labs'])>0)
                  @foreach($data['labs'] as $key => $l)
                    @if($x->lab_id == $l['lab_id'])
											@if($i==0)                       
											<div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                    @endif
                  @endforeach
                @endif
                 </div>
                 
                @endif
                @endif
              @endforeach
              
              @if($a==0)
               
              <div style="display:none" class="editSlot">
                <select id="lec" class="form-control">
                  @foreach($data['custom'] as $z)
                    @if($z->slot_id == 4 && $z->day == 'Thursday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                      <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                    @endif
                    @endforeach
                </select>
                <input type="hidden" value="0">
                <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
              </div>
              <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
                 @endif
            </td>
            @endif
          @if($data['slotCount']>=5)
            <td>
                <?php $a = 0; ?>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Thursday')
                  @if($x->slot_no == 5)
                  <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                  <div style="display:none" class="editSlot">
                      <select id="lec" class="form-control">
                        @foreach($data['custom'] as $z)
                          @if($z->slot_id == 5 && $z->day == 'Thursday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                            <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                          @endif
                          @endforeach
                      </select>
                      <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                      <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                    </div>
                   <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                  <span class="text-primary">{{$x->name}} </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r['room_id'])
										@if($i == 0)                     
										{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     @endif
                  @endif
                @endforeach
                @if(count($data['labs'])>0)
                  @foreach($data['labs'] as $key => $l)
                    @if($x->lab_id == $l['lab_id'])
                      @if($i==0)
                      <div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>
                      @endif
                    @endif
                  @endforeach
                @endif
                 </div>
                 
             
                @endif
                @endif
              @endforeach
              @if($a==0)
               
              <div style="display:none" class="editSlot">
                <select id="lec" class="form-control">
                  @foreach($data['custom'] as $z)
                    @if($z->slot_id == 5 && $z->day == 'Thursday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                      <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                    @endif
                    @endforeach
                </select>
                <input type="hidden" value="0">
                <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
              </div>
              <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
                 @endif
            </td>
            @endif
          @if($data['slotCount']>=6)
            <td>
                <?php $a = 0; ?>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Thursday')
                  @if($x->slot_no == 6)
                  <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                  <div style="display:none" class="editSlot">
                      <select id="lec" class="form-control">
                        @foreach($data['custom'] as $z)
                          @if($z->slot_id == 6 && $z->day == 'Thursday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                            <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                          @endif
                          @endforeach
                      </select>
                      <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                      <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                    </div>
                   <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                  <span class="text-primary">{{$x->name}} </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r['room_id'])
										@if($i == 0)                     
										{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     @endif
                  @endif
                @endforeach
                @if(count($data['labs'])>0)
                  @foreach($data['labs'] as $key => $l)
                    @if($x->lab_id == $l['lab_id'])
											@if($i==0)                       
											<div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                    @endif
                  @endforeach
                @endif
                 </div>
           
                @endif
                @endif
              @endforeach
                    
              @if($a==0)
               
              <div style="display:none" class="editSlot">
                <select id="lec" class="form-control">
                  @foreach($data['custom'] as $z)
                    @if($z->slot_id == 6 && $z->day == 'Thursday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                      <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                    @endif
                    @endforeach
                </select>
                <input type="hidden" value="0">
                <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
              </div>
              <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
                 @endif
            </td>
            @endif
          @if($data['slotCount']>=7)
            <td>
                <?php $a = 0; ?>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Thursday')
                  @if($x->slot_no == 7)
                  <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                  <div style="display:none" class="editSlot">
                      <select id="lec" class="form-control">
                        @foreach($data['custom'] as $z)
                          @if($z->slot_id == 7 && $z->day == 'Thursday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                            <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                          @endif
                          @endforeach
                      </select>
                      <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                      <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                    </div>
                   <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                  <span class="text-primary">{{$x->name}} </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r['room_id'])
										@if($i == 0)                     
										{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     @endif
                  @endif
                @endforeach
                @if(count($data['labs'])>0)
                  @foreach($data['labs'] as $key => $l)
                    @if($x->lab_id == $l['lab_id'])
											@if($i==0)                       
											<div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                    @endif
                  @endforeach
                @endif
                 </div>
              
                @endif
                @endif
              @endforeach
                 
              @if($a==0)
               
              <div style="display:none" class="editSlot">
                <select id="lec" class="form-control">
                  @foreach($data['custom'] as $z)
                    @if($z->slot_id == 7 && $z->day == 'Thursday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                      <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                    @endif
                    @endforeach
                </select>
                <input type="hidden" value="0">
                <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
              </div>
              <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
                 @endif
            </td>
            @endif
          @if($data['slotCount']>=8)
            <td>
                <?php $a = 0; ?>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Thursday')
                  @if($x->slot_no == 8)
                  <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                  <div style="display:none" class="editSlot">
                      <select id="lec" class="form-control">
                        @foreach($data['custom'] as $z)
                          @if($z->slot_id == 8 && $z->day == 'Thursday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                            <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                          @endif
                          @endforeach
                      </select>
                      <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                      <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                    </div>
                   <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                  <span class="text-primary">{{$x->name}} </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r['room_id'])
										@if($i == 0)                     
										{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     @endif
                  @endif
                @endforeach
                @if(count($data['labs'])>0)
                  @foreach($data['labs'] as $key => $l)
                    @if($x->lab_id == $l['lab_id'])
											@if($i==0)                       
											<div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                    @endif
                  @endforeach
                @endif
                 </div>
                 
               
                @endif
                @endif
              @endforeach
              @if($a==0)
               
               <div style="display:none" class="editSlot">
                 <select id="lec" class="form-control">
                   @foreach($data['custom'] as $z)
                     @if($z->slot_id == 8 && $z->day == 'Thursday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                       <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                     @endif
                     @endforeach
                 </select>
                 <input type="hidden" value="0">
                 <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
               </div>
               <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
                  @endif
            </td>
            @endif
         
        </tr>
         <tr>
          <td>Friday </td>
          
          @if($data['slotCount']>=1)
          <td>
              <?php $a = 0; ?>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Friday')
                  @if($x->slot_no == 1)
                  <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                  <div style="display:none" class="editSlot">
                      <select id="lec" class="form-control">
                        @foreach($data['custom'] as $z)
                          @if($z->slot_id == 1 && $z->day == 'Friday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                            <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                          @endif
                          @endforeach
                      </select>
                      <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                      <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                    </div>
                   <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                  <span class="text-primary">{{$x->name}} </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r['room_id'])
										@if($i == 0)                     
										{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     @endif
                  @endif
                @endforeach
                @if(count($data['labs'])>0)
                  @foreach($data['labs'] as $key => $l)
                    @if($x->lab_id == $l['lab_id'])
											@if($i==0)                       
											<div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                    @endif
                  @endforeach
                @endif
               </div>

               
                @endif
                @endif
              @endforeach
              
              @if($a==0)
                
              <div style="display:none" class="editSlot">
                <select id="lec" class="form-control">
                  @foreach($data['custom'] as $z)
                    @if($z->slot_id == 1 && $z->day == 'Friday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                      <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                    @endif
                    @endforeach
                </select>
                <input type="hidden" value="0">
                <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
              </div>
              <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
                @endif
            </td>
            @endif
          @if($data['slotCount']>=2)
            <td>
                <?php $a = 0; ?>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Friday')
                  @if($x->slot_no == 2)
                  <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                  <div style="display:none" class="editSlot">
                      <select id="lec" class="form-control">
                        @foreach($data['custom'] as $z)
                          @if($z->slot_id == 2 && $z->day == 'Friday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                            <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                          @endif
                          @endforeach
                      </select>
                      <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                      <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                    </div>
                   <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                  <span class="text-primary">{{$x->name}} </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r['room_id'])
										@if($i == 0)                     
										{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     @endif
                  @endif
                @endforeach
                @if(count($data['labs'])>0)
                  @foreach($data['labs'] as $key => $l)
                    @if($x->lab_id == $l['lab_id'])
											@if($i==0)                       
											<div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                    @endif
                  @endforeach
                @endif
                 </div>
                 
              
                @endif
                @endif
              @endforeach
              @if($a==0)
               
              <div style="display:none" class="editSlot">
                <select id="lec" class="form-control">
                  @foreach($data['custom'] as $z)
                    @if($z->slot_id == 2 && $z->day == 'Friday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                      <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                    @endif
                    @endforeach
                </select>
                <input type="hidden" value="0">
                <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
              </div>
              <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
                 @endif
            </td>
            @endif
          @if($data['slotCount']>=3)
            <td>
                <?php $a = 0; ?>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Friday')
                  @if($x->slot_no == 3)
                  <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                  <div style="display:none" class="editSlot">
                      <select id="lec" class="form-control">
                        @foreach($data['custom'] as $z)
                          @if($z->slot_id == 3 && $z->day == 'Friday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                            <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                          @endif
                          @endforeach
                      </select>
                      <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                      <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                    </div>
                   <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                  <span class="text-primary">{{$x->name}} </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
									<br>
								<?php $i= 0 ;?>
									
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r['room_id'])
										@if($i == 0)                     
										{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     @endif
                  @endif
                @endforeach
                @if(count($data['labs'])>0)
                  @foreach($data['labs'] as $key => $l)
                    @if($x->lab_id == $l['lab_id'])
											@if($i==0)                      
											 <div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                    @endif
                  @endforeach
                @endif
                 </div>
                
                @endif
                @endif
              @endforeach
               
              @if($a==0)
               
              <div style="display:none" class="editSlot">
                <select id="lec" class="form-control">
                  @foreach($data['custom'] as $z)
                    @if($z->slot_id == 3 && $z->day == 'Friday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                      <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                    @endif
                    @endforeach
                </select>
                <input type="hidden" value="0">
                <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
              </div>
              <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
                 @endif
            </td>
            @endif
          @if($data['slotCount']>=4)
            <td>
                <?php $a = 0; ?>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Friday')
                  @if($x->slot_no == 4)
                  <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                  <div style="display:none" class="editSlot">
                      <select id="lec" class="form-control">
                        @foreach($data['custom'] as $z)
                          @if($z->slot_id == 4 && $z->day == 'Friday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                            <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                          @endif
                          @endforeach
                      </select>
                      <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                      <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                    </div>
                   <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                  <span class="text-primary">{{$x->name}} </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r['room_id'])
										@if($i == 0)                     
										{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     @endif
                  @endif
                @endforeach
                @if(count($data['labs'])>0)
                  @foreach($data['labs'] as $key => $l)
                    @if($x->lab_id == $l['lab_id'])
											@if($i==0)                       
											<div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                    @endif
                  @endforeach
                @endif
                 </div>
                 
                @endif
                @endif
              @endforeach
              
              @if($a==0)
               
              <div style="display:none" class="editSlot">
                <select id="lec" class="form-control">
                  @foreach($data['custom'] as $z)
                    @if($z->slot_id == 4 && $z->day == 'Friday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                      <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                    @endif
                    @endforeach
                </select>
                <input type="hidden" value="0">
                <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
              </div>
              <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
                 @endif
            </td>
            @endif
          @if($data['slotCount']>=5)
            <td>
                <?php $a = 0; ?>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Friday')
                  @if($x->slot_no == 5)
                  <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                  <div style="display:none" class="editSlot">
                      <select id="lec" class="form-control">
                        @foreach($data['custom'] as $z)
                          @if($z->slot_id == 5 && $z->day == 'Friday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                            <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                          @endif
                          @endforeach
                      </select>
                      <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                      <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                    </div>
                   <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                  <span class="text-primary">{{$x->name}} </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r['room_id'])
										@if($i == 0)                     
										{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     @endif
                  @endif
                @endforeach
                @if(count($data['labs'])>0)
                  @foreach($data['labs'] as $key => $l)
                    @if($x->lab_id == $l['lab_id'])
                      @if($i==0)                       <div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                    @endif
                  @endforeach
                @endif
                 </div>
                 
              
                @endif
                @endif
              @endforeach
              @if($a==0)
               
              <div style="display:none" class="editSlot">
                <select id="lec" class="form-control">
                  @foreach($data['custom'] as $z)
                    @if($z->slot_id == 5 && $z->day == 'Friday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                      <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                    @endif
                    @endforeach
                </select>
                <input type="hidden" value="0">
                <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
              </div>
              <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
                 @endif
            </td>
            @endif
          @if($data['slotCount']>=6)
            <td>
                <?php $a = 0; ?>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Friday')
                  @if($x->slot_no == 6)
                  <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                  <div style="display:none" class="editSlot">
                      <select id="lec" class="form-control">
                        @foreach($data['custom'] as $z)
                          @if($z->slot_id == 6 && $z->day == 'Friday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                            <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                          @endif
                          @endforeach
                      </select>
                      <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                      <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                    </div>
                   <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                  <span class="text-primary">{{$x->name}} </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r['room_id'])
										@if($i == 0)                     
										{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     @endif
                  @endif
                @endforeach
                @if(count($data['labs'])>0)
                  @foreach($data['labs'] as $key => $l)
                    @if($x->lab_id == $l['lab_id'])
											@if($i==0)                       
											<div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                    @endif
                  @endforeach
                @endif
                 </div>
                 
                @endif
                @endif
              @endforeach
              
              @if($a==0)
               
              <div style="display:none" class="editSlot">
                <select id="lec" class="form-control">
                  @foreach($data['custom'] as $z)
                    @if($z->slot_id == 6 && $z->day == 'Friday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                      <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                    @endif
                    @endforeach
                </select>
                <input type="hidden" value="0">
                <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
              </div>
              <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
                 @endif
            </td>
            @endif
          @if($data['slotCount']>=7)
            <td>
                <?php $a = 0; ?>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Friday')
                  @if($x->slot_no == 7)
                  <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                  <div style="display:none" class="editSlot">
                      <select id="lec" class="form-control">
                        @foreach($data['custom'] as $z)
                          @if($z->slot_id == 7 && $z->day == 'Friday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                            <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                          @endif
                          @endforeach
                      </select>
                      <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                      <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                    </div>
                   <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                  <span class="text-primary">{{$x->name}} </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r['room_id'])
										@if($i == 0)                     
										{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     @endif
                  @endif
                @endforeach
                @if(count($data['labs'])>0)
                  @foreach($data['labs'] as $key => $l)
                    @if($x->lab_id == $l['lab_id'])
                      @if($i==0)
                      <div class="bg-danger">                       
                      {{$l['block_name']}}-{{$l['lab_name']}}
                      </div> 										
                      <?php $i++; ?>                       
                      @endif
                    @endif
                  @endforeach
                @endif
                 </div>
                
                @endif
                @endif
              @endforeach
               
              @if($a==0)
               
              <div style="display:none" class="editSlot">
                <select id="lec" class="form-control">
                  @foreach($data['custom'] as $z)
                    @if($z->slot_id == 7 && $z->day == 'Friday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                      <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                    @endif
                    @endforeach
                </select>
                <input type="hidden" value="0">
                <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
              </div>
              <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
                 @endif
            </td>
            @endif
          @if($data['slotCount']>=8)
            <td>
                <?php $a = 0; ?>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Friday')
                  @if($x->slot_no == 8)
                  <?php $a++ ?>                 <span class="pull-right dataBtn" style="display:none"><i class="fa fa-bookmark" aria-hidden="true"></i></i></span>
                  <div style="display:none" class="editSlot">
                      <select id="lec" class="form-control">
                        @foreach($data['custom'] as $z)
                          @if($z->slot_id == 8 && $z->day == 'Friday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                            <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                          @endif
                          @endforeach
                      </select>
                      <input type="hidden" class="prevVal" value="{{$x->timetable_id}}">
                      <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
                    </div>
                   <div class="dataSlot @if($x->type != 'regular') bg-warning @elseif($x->status == 'custom') bg-info @endif">
                  <span class="text-primary">{{$x->name}} </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r['room_id'])
										@if($i == 0)                     
										{{$r['block_name']}}-{{$r['room_no']}} 											<?php $i++; ?>                     @endif
                  @endif
                @endforeach
                @if(count($data['labs'])>0)
                  @foreach($data['labs'] as $key => $l)
                    @if($x->lab_id == $l['lab_id'])
											@if($i==0)                       
											<div class="bg-danger">                                              {{$l['block_name']}}-{{$l['lab_name']}}                       </div>   										<?php $i++; ?>                       @endif
                    @endif
                  @endforeach
                @endif
                 </div>
                 
              
                @endif
                @endif
              @endforeach
              @if($a==0)
               
              <div style="display:none" class="editSlot">
                <select id="lec" class="form-control">
                  @foreach($data['custom'] as $z)
                    @if($z->slot_id == 8 && $z->day == 'Friday' && $z->semester <= $data['stdSemester'][0]->semester && $z->prg_id == $data['stdSemester'][0]->prg_id)
                      <option value="{{$z->timetable_id}}">{{$z->course_name}}</option>
                    @endif
                    @endforeach
                </select>
                <input type="hidden" value="0">
                <button class="btn btn-primary book"  style="margin-top:5px;" >Book</button> <br>
              </div>
              <button class="btn btn-primary editBtn" style="display:none;margin-top:5px;"  >Book Slot</button>
                 @endif
            </td>
            @endif
         
        </tr>
         

      </tbody>
    </table>
  </div>
{{-- {{$timetable->links()}} --}}

<script>
  function showBtn(){
    jQuery(document).ready(function(){
      jQuery('.editBtn').show();
      jQuery('.dataBtn').show();
    })
  }
  
    

    jQuery(document).ready(function(){
      jQuery('.dataBtn').on('click',function(){
        var c = jQuery(this).next().next('div').hide();
        var a = jQuery(this).next('div').show();
        // console.log(c)
      });
      jQuery('.editBtn').on('click',function(){
        var c = jQuery(this).prev('div').show();
        // console.log(c)
      });
       jQuery('.book').on('click',function(){
        var newSub = jQuery(this).prev().prev('select').find('option:selected').val();
        var prevSub = jQuery(this).prev('input').val();
        // console.log(prevSub);
        // console.log(newSub);
        jQuery.ajax({
        url: "{{ url('/addCustom') }}",
        method: 'post',
        data: {
          newSub: newSub,
          prevSub: prevSub,
        //  sem_id: sem_id,
        },
        headers:{
          'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
        // console.log(response);
        location.reload();
        
        }});

      });
    })
    
  
</script>





@endsection
