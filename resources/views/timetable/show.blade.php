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


  <table class="table  table-responsive table-bordered text-center">
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
            @foreach($data['timetable'] as $x)
              @if($x->day == 'Monday')
                @if($x->slot_no == 1)
                 <div @if($x->type != 'regular') class="bg-warning" @endif>
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
          </div>
          </td>

          @endif
          @if($data['slotCount']>=2)
          <td>
            @foreach($data['timetable'] as $x)
              @if($x->day == 'Monday')
                @if($x->slot_no == 2)
               <div @if($x->type != 'regular') class="bg-warning" @endif>
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
          </td>
          @endif
          @if($data['slotCount']>=3)
          <td>
            @foreach($data['timetable'] as $x)
              @if($x->day == 'Monday')
                @if($x->slot_no == 3)
               <div @if($x->type != 'regular') class="bg-warning" @endif>
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
          </td>
          @endif
          @if($data['slotCount']>=4)
          <td>
            @foreach($data['timetable'] as $x)
              @if($x->day == 'Monday')
                @if($x->slot_no == 4)
               <div @if($x->type != 'regular') class="bg-warning" @endif>
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
          </td>
          @endif
          @if($data['slotCount']>=5)
          <td>
            @foreach($data['timetable'] as $x)
              @if($x->day == 'Monday')
                @if($x->slot_no == 5)
               <div @if($x->type != 'regular') class="bg-warning" @endif>
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
          </td>
          @endif
          @if($data['slotCount']>=6)
          <td>
            @foreach($data['timetable'] as $x)
              @if($x->day == 'Monday')
                @if($x->slot_no == 6)
               <div @if($x->type != 'regular') class="bg-warning" @endif>
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
          </td>
          @endif
          @if($data['slotCount']>=7)
          <td>
            @foreach($data['timetable'] as $x)
              @if($x->day == 'Monday')
                @if($x->slot_no == 7)
               <div @if($x->type != 'regular') class="bg-warning" @endif>
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
          </td>
          @endif
          @if($data['slotCount']>=8)
          <td>
            @foreach($data['timetable'] as $x)
              @if($x->day == 'Monday')
                @if($x->slot_no == 8)
               <div @if($x->type != 'regular') class="bg-warning" @endif>
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
          </td>
          @endif
          
          
        </tr>
         <tr>
          <td>Tuesday</td>
         
          @if($data['slotCount']>=1)
          <td>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Tuesday')
                  @if($x->slot_no == 1)
               <div @if($x->type != 'regular') class="bg-warning" @endif>
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
            </td>
            @endif
          @if($data['slotCount']>=2)
            <td>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Tuesday')
                  @if($x->slot_no == 2)
                 <div @if($x->type != 'regular') class="bg-warning" @endif>
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
            </td>
            @endif
          @if($data['slotCount']>=3)
            <td>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Tuesday')
                  @if($x->slot_no == 3)
                 <div @if($x->type != 'regular') class="bg-warning" @endif>
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
            </td>
            @endif
          @if($data['slotCount']>=4)
            <td>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Tuesday')
                  @if($x->slot_no == 4)
                 <div @if($x->type != 'regular') class="bg-warning" @endif>
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
            </td>
            @endif
          @if($data['slotCount']>=5)
            <td>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Tuesday')
                  @if($x->slot_no == 5)
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
            </td>
            @endif
          @if($data['slotCount']>=6)
            <td>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Tuesday')
                  @if($x->slot_no == 6)
                 <div @if($x->type != 'regular') class="bg-warning" @endif>
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
            </td>
            @endif
          @if($data['slotCount']>=7)
            <td>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Tuesday')
                  @if($x->slot_no == 7)
                 <div @if($x->type != 'regular') class="bg-warning" @endif>
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
            </td>
            @endif
          @if($data['slotCount']>=8)
            <td>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Tuesday')
                  @if($x->slot_no == 8)
                 <div @if($x->type != 'regular') class="bg-warning" @endif>
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
            </td>
            @endif
          
        </tr>
         <tr>
          <td>Wednesday</td>
          
          @if($data['slotCount']>=1)

          <td>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Wednesday')
                  @if($x->slot_no == 1)
               <div @if($x->type != 'regular') class="bg-warning" @endif>
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
            </td>
            @endif
          @if($data['slotCount']>=2)
            <td>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Wednesday')
                  @if($x->slot_no == 2)
                 <div @if($x->type != 'regular') class="bg-warning" @endif>
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
            </td>
            @endif
          @if($data['slotCount']>=3)
            <td>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Wednesday')
                  @if($x->slot_no == 3)
                 <div @if($x->type != 'regular') class="bg-warning" @endif>
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
            </td>
            @endif
          @if($data['slotCount']>=4)
            <td>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Wednesday')
                  @if($x->slot_no == 4)
                 <div @if($x->type != 'regular') class="bg-warning" @endif>
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
            </td>
            @endif
          @if($data['slotCount']>=5)
            <td>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Wednesday')
                  @if($x->slot_no == 5)
                 <div @if($x->type != 'regular') class="bg-warning" @endif>
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
            </td>
            @endif
          @if($data['slotCount']>=6)
            <td>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Wednesday')
                  @if($x->slot_no == 6)
                 <div @if($x->type != 'regular') class="bg-warning" @endif>
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
            </td>
            @endif
          @if($data['slotCount']>=7)
            <td>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Wednesday')
                  @if($x->slot_no == 7)
                 <div @if($x->type != 'regular') class="bg-warning" @endif>
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
            </td>
            @endif
          @if($data['slotCount']>=8)
            <td>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Wednesday')
                  @if($x->slot_no == 8)
                 <div @if($x->type != 'regular') class="bg-warning" @endif>
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
            </td>
            @endif
          
        </tr>
         <tr>
          <td>Thursday</td>
          
          @if($data['slotCount']>=1)
          <td>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Thursday')
                  @if($x->slot_no == 1)
               <div @if($x->type != 'regular') class="bg-warning" @endif>
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
            </td>
            @endif
          @if($data['slotCount']>=2)
            <td>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Thursday')
                  @if($x->slot_no == 2)
                 <div @if($x->type != 'regular') class="bg-warning" @endif>
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
            </td>
            @endif
          @if($data['slotCount']>=3)
            <td>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Thursday')
                  @if($x->slot_no == 3)
                 <div @if($x->type != 'regular') class="bg-warning" @endif>
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
            </td>
            @endif
          @if($data['slotCount']>=4)
            <td>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Thursday')
                  @if($x->slot_no == 4)
                 <div @if($x->type != 'regular') class="bg-warning" @endif>
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
            </td>
            @endif
          @if($data['slotCount']>=5)
            <td>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Thursday')
                  @if($x->slot_no == 5)
                 <div @if($x->type != 'regular') class="bg-warning" @endif>
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
            </td>
            @endif
          @if($data['slotCount']>=6)
            <td>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Thursday')
                  @if($x->slot_no == 6)
                 <div @if($x->type != 'regular') class="bg-warning" @endif>
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
            </td>
            @endif
          @if($data['slotCount']>=7)
            <td>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Thursday')
                  @if($x->slot_no == 7)
                 <div @if($x->type != 'regular') class="bg-warning" @endif>
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
            </td>
            @endif
          @if($data['slotCount']>=8)
            <td>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Thursday')
                  @if($x->slot_no == 8)
                 <div @if($x->type != 'regular') class="bg-warning" @endif>
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
            </td>
            @endif
         
        </tr>
         <tr>
          <td>Friday </td>
          
          @if($data['slotCount']>=1)
          <td>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Friday')
                  @if($x->slot_no == 1)
               <div @if($x->type != 'regular') class="bg-warning" @endif>
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
            </td>
            @endif
          @if($data['slotCount']>=2)
            <td>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Friday')
                  @if($x->slot_no == 2)
                 <div @if($x->type != 'regular') class="bg-warning" @endif>
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
            </td>
            @endif
          @if($data['slotCount']>=3)
            <td>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Friday')
                  @if($x->slot_no == 3)
                 <div @if($x->type != 'regular') class="bg-warning" @endif>
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
            </td>
            @endif
          @if($data['slotCount']>=4)
            <td>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Friday')
                  @if($x->slot_no == 4)
                 <div @if($x->type != 'regular') class="bg-warning" @endif>
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
            </td>
            @endif
          @if($data['slotCount']>=5)
            <td>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Friday')
                  @if($x->slot_no == 5)
                 <div @if($x->type != 'regular') class="bg-warning" @endif>
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
            </td>
            @endif
          @if($data['slotCount']>=6)
            <td>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Friday')
                  @if($x->slot_no == 6)
                 <div @if($x->type != 'regular') class="bg-warning" @endif>
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
            </td>
            @endif
          @if($data['slotCount']>=7)
            <td>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Friday')
                  @if($x->slot_no == 7)
                 <div @if($x->type != 'regular') class="bg-warning" @endif>
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
            </td>
            @endif
          @if($data['slotCount']>=8)
            <td>
              @foreach($data['timetable'] as $x)
                @if($x->day == 'Friday')
                  @if($x->slot_no == 8)
                 <div @if($x->type != 'regular') class="bg-warning" @endif>
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
            </td>
            @endif
         
        </tr>
         

      </tbody>
    </table>
{{-- {{$timetable->links()}} --}}





@endsection
