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
    <?php echo Auth::user()->name ?>
    {{-- @if(!empty($data['std']))
    {{$data['std']->batch_name}}
    @endif
    @if(count($data['timetable'])  !=  0)
    {{$data['timetable'][0]->prg_name}}-{{$data['timetable'][0]->sec_name}}  (Semester {{$data['timetable'][0]->semester}})
    @endif --}}
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
                 <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                 {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
								<br>
								<?php $i= 0 ;?>
                 @foreach($data['rooms'] as $key => $r)
                    @if($x->room_id == $r->room_id)
											@if($i == 0)                     
											{{$r->block_name}}-{{$r->room_no}}
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
                <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                 {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
								<br>
								<?php $i= 0 ;?>
								
               @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r->room_id)
										@if($i == 0)                     
										{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     @endif
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
                <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                 {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
								<br>
								<?php $i= 0 ;?>
								
               @foreach($data['rooms'] as $key => $r)
                @if($x->room_id == $r->room_id)
									@if($i == 0)                     
									{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     
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
                <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                 {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
								<br>
								<?php $i= 0 ;?>
								
               @foreach($data['rooms'] as $key => $r)
                @if($x->room_id == $r->room_id)
									@if($i == 0)                     
									{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                    
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
                <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                 {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
								<br>
								<?php $i= 0 ;?>
								
               @foreach($data['rooms'] as $key => $r)
                @if($x->room_id == $r->room_id)
									@if($i == 0)                     
									{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     
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
                <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                 {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
								<br>
								<?php $i= 0 ;?>
								
               @foreach($data['rooms'] as $key => $r)
                @if($x->room_id == $r->room_id)
									@if($i == 0)                     
									{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     
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
                <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                 {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
								<br>
								<?php $i= 0 ;?>
								
               @foreach($data['rooms'] as $key => $r)
                @if($x->room_id == $r->room_id)
									@if($i == 0)                     
									{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     
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
                <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                 {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
								<br>
								<?php $i= 0 ;?>
								
               @foreach($data['rooms'] as $key => $r)
                @if($x->room_id == $r->room_id)
									@if($i == 0)                     
									{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     
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
                  <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
									<br>
								<?php $i= 0 ;?>
									
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r->room_id)
										@if($i == 0)                     
										{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     @endif
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
                  <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
									<br>
								<?php $i= 0 ;?>
									
                   @foreach($data['rooms'] as $key => $r)
                    @if($x->room_id == $r->room_id)
											@if($i == 0)                     
											{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     @endif
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
                  <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r->room_id)
										@if($i == 0)                    
										 {{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     @endif
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
                  <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                  
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								 </div>
								<?php $i= 0 ;?>
								 
                @foreach($data['rooms'] as $key => $r)
                 @if($x->room_id == $r->room_id)
									 @if($i == 0)                     
									 {{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     @endif
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
                   <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                    @if($x->room_id == $r->room_id)
											@if($i == 0)                     
											{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     @endif
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
                  <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
									<br>
								<?php $i= 0 ;?>
									
                 
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r->room_id)
										@if($i == 0)                     
										{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     @endif
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
                  <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
									<br>
								<?php $i= 0 ;?>
									
                 
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r->room_id)
										@if($i == 0)                     
										{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     @endif
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
                  <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
									<br>
								<?php $i= 0 ;?>
									
                 
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r->room_id)
										@if($i == 0)                     
										{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     @endif
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
                  <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                 
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r->room_id)
										@if($i == 0)                     
										{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     @endif
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
                  <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r->room_id)
										@if($i == 0)                     
										{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     @endif
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
                  <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r->room_id)
										@if($i == 0)                     
										{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     @endif
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
                  <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r->room_id)
										@if($i == 0)                     
										{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     @endif
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
                  <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r->room_id)
										@if($i == 0)                     
										{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     @endif
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
                  <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r->room_id)
										@if($i == 0)                     
										{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     @endif
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
                  <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r->room_id)
										@if($i == 0)                     
										{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     @endif
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
                  <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r->room_id)
										@if($i == 0)                     
										{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     @endif
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
                  <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r->room_id)
										@if($i == 0)                     
										{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     @endif
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
                  <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
									<?php $i= 0 ;?>
 
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r->room_id)
                    @if($i == 0)
                    {{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>
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
                  <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r->room_id)
										@if($i == 0)                     
										{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     @endif
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
                  <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                  @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r->room_id)
										@if($i == 0)                     
										{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     @endif
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
                  <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r->room_id)
										@if($i == 0)                     
										{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     @endif
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
                  <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r->room_id)
										@if($i == 0)                     
										{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     @endif
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
                  <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r->room_id)
										@if($i == 0)                     
										{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     @endif
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
                  <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r->room_id)
										@if($i == 0)                     
										{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     @endif
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
                  <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r->room_id)
										@if($i == 0)                     
										{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     @endif
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
                  <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r->room_id)
										@if($i == 0)                     
										{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     @endif
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
                  <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
									<br>
								<?php $i= 0 ;?>
									
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r->room_id)
										@if($i == 0)                     
										{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     @endif
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
                  <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r->room_id)
										@if($i == 0)                     
										{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     @endif
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
                  <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r->room_id)
										@if($i == 0)                     
										{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     @endif
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
                  <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r->room_id)
										@if($i == 0)                     
										{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     @endif
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
                  <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r->room_id)
										@if($i == 0)                     
										{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     @endif
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
                  <span class="text-primary">{{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}}) </span><br>
                  <span class="text-uppercase font-weight-bold">{{$x->course_name}}</span><br>
                   {{-- {{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}}) --}}
                  <br>
								<?php $i= 0 ;?>
                  
                 @foreach($data['rooms'] as $key => $r)
                  @if($x->room_id == $r->room_id)
										@if($i == 0)                     
										{{$r->block_name}}-{{$r->room_no}} 											<?php $i++; ?>                     @endif
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



    {{-- {{$timetable->links()}} --}}
  
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modelId">
        Request For Makeup Lecture
      </button>
      <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modelI">
        Request For Change Lecture
      </button>
      
      <!-- Modal -->
      <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Modal title</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                  </div>
                  
                {!! Form::open(['action' => 'MakeupRequestesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data','class' => 'form p-5']) !!}
                  <div class="modal-body">
                    <div class="form-group">
                        {{Form::label('sec_id','Section')}}
                       <select class="form-control" name="sec_id">
                           @foreach ($data['sections'] as $x)
                       <option value="{{$x->sec_id}}">{{$x->prg_name}} ({{$x->semester}}-{{$x->sec_name}})</option>                       
                           @endforeach
                       </select>
                    </div>
    
                    <div class="form-group">
                        {{Form::label('room_id','Room No')}}
                        <select class="form-control" name="room_id">
                            @foreach ($data['rooms'] as $room)
                        <option value="{{$room->room_id}}">{{$room->block_name}} (Room No {{$room->room_no}} )</option>
                            @endforeach
                        </select>
                    </div>  
    
                    <div class="form-group">
                        {{Form::label('slot_id','Slot')}}
                        <select class="form-control" name="slot_id">
                            @foreach ($data['slot'] as $slot)
                        <option value="{{$slot->slot_id}}">{{$slot->slot_time}} (Slot No {{$slot->slot_no}} )</option>
                            @endforeach
                        </select>
                    </div> 
                    
                    <div class="form-group">
                        {{Form::label('day','Day')}}
                        {{Form::select('day',$days,null,['class' => 'form-control','id' => 'day'])}}
                    </div> 
    
                    {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
                    {!! Form::close() !!}
    
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save</button>
                  </div>
              </div>
          </div>
      </div>
    
<!-- Modal -->
      <div class="modal fade" id="modelI" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Change Lecture</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                  </div>
                  
                {!! Form::open(['action' => 'shiftLecController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data','class' => 'form p-5']) !!}
                  <div class="modal-body">
                    
                      <div class="form-group">
                          {{Form::label('shiftSlot','Shifting Slot')}}
                          <select class="form-control" name="shiftSlot">
                              @foreach ($data['timetable'] as $x)
                          <option value="{{$x->timetable_id}}">{{$x->course_name}} {{$x->prg_name}}({{$x->semester}} - {{$x->sec_name}})---{{$x->day}}--(slot-{{$x->slot_no}})</option>
                              @endforeach
                          </select>
                      </div> 
    
                    <div class="form-group">
                        {{Form::label('slot_id','Slot')}}
                        <select class="form-control" name="slot_id">
                            @foreach ($data['slot'] as $slot)
                        <option value="{{$slot->slot_id}},{{$slot->slot_no}}">{{$slot->slot_time}} (Slot No {{$slot->slot_no}} )</option>
                            @endforeach
                        </select>
                    </div> 
                    
                    <div class="form-group">
                        {{Form::label('day','Day')}}
                        {{Form::select('day',$days,null,['class' => 'form-control','id' => 'day'])}}
                    </div> 
    
                    {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
                    {!! Form::close() !!}
    
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save</button>
                  </div>
              </div>
          </div>
      </div>
    


@endsection
