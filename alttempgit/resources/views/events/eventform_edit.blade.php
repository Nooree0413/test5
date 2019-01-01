@extends('layouts.adminfound')
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/form-icons.css')}}">
    <link rel="icon" href="{{asset('images/editEvent.png')}}" />
    <title>Edit Event</title>
</head>


@section('content')
<div class="grid-x padding_cell">
        <div class="cell small-1"></div> 
        <div class="cell small-1 space-cell">
            <a href="/eventfound/view" class="back-btn hvr-icon-back"><i class="fa fa-chevron-circle-left hvr-icon icon-back"></i> Back</a>
        </div>
    </div>
<div class="grid-x">
        <div class="cell small-1"></div> 
        <div class="cell small-10">
                <fieldset class="addUserFieldset editeventFieldset">
                    <legend class="addUserLegend">Edit Event</legend>
    <div class="cell small-11 eventFormContainer">
    <form method="POST" enctype="multipart/form-data" class="cssAddEvent" data-abide novalidate autocomplete="off"> 
      @csrf
        {{-- <h3 class="text-center-heading addEventTitle">Edit Event</h3> --}}
        {{-- Event Name Form field --}}
            <div class="input-group">
                <span class="input-group-label">
                <i class="fa fa-bookmark"></i>
                </span>
                <input class="input-group-field {{ $errors->has('txtename') ? ' is-invalid-input' : '' }}" name="txtename" value="{{$event->name}}" type="text" placeholder="Event name">
            {{-- Image Form Field --}}
                    <div class="input-group-button">
                        <label for="image_path" data-tooltip tabindex="2" title="Add an Event Image" class="custom-file-upload top" id="lblimg">
                            <i class="fa fa-image"></i>
                        </label>
                        <input  id="image_path" onchange="changeInputField()"class="button" type="file" name="image_path">
                    </div>
                    <input id="oldEventPic" name="oldEventPic" type="hidden" value="{{$event->image_path}}">
                    <img id="oldEventPic" src="{{asset('images/'.$event->image_path)}}">
            {{-- /Image Form Field --}}
            </div>
            @if($errors->has('txtename'))
                <span class="form-error is-visible">{{$errors->first('txtename')}}</span>
            @endif
        {{-- /Event Name Form field --}}
           
        {{-- Event Description Textarea --}}
                <div class="input-group">
                <span class="input-group-label">
                    <i class="fa fa-book"></i>
                </span>
                <textarea class="input-group-field {{ $errors->has('description') ? ' is-invalid-input' : '' }}" name="description" type="text" placeholder="Description of event">{{ $event->description}}</textarea>
                </div>
                @if($errors->has('description'))
                    <span class="form-error is-visible">{{$errors->first('description')}}</span>
                @endif
        {{-- /Event Description Textarea --}}
            
        <div class="grid-x grid-margin-x">
            <div class="cell medium-6">
        {{-- Status Combo box --}}
            <div class="input-group">
                <span class="input-group-label">
                    <i class="fa fa-plus-circle"></i>
                </span> 
                <select id="status" class="input-group-field {{ $errors->has('status') ? ' is-invalid-input' : '' }}" name="status">
                    <?php $status_id= $event->status_id?>
                    @foreach ($status as $event_status)
                        <?php $id=$event_status->id ?>
                        @if($status_id==$id)
                            <option value="{{$event_status->id}}" selected>{{$event_status->status}}</option>
                        @else
                            <option value="{{$event_status->id}}">{{$event_status->status}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            @if($errors->has('status'))
                <span class="form-error is-visible">{{$errors->first('status')}}</span>
            @endif
        {{-- /Status Combo box --}}
            </div>
        
            <div class="cell medium-6">
        {{-- Type Combo box --}} 
            <div class="input-group">
                <span class="input-group-label">
                    <i class="fa fa-plus-circle"></i>
                </span>
                <select id="type" class="input-group-field {{ $errors->has('type') ? ' is-invalid-input' : '' }}" name="type">
                    <option selected disabled>Choose type</option>
                    <?php $type_id= $event->type_id?>
                    @foreach ($type as $event_type)
                        <?php $id=$event_type->id ?>
                        @if($type_id==$id)
                            <option value="{{$event_type->id}}" selected>{{$event_type->type}}</option>
                        @else
                            <option value="{{$event_type->id}}">{{$event_type->type}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            @if($errors->has('type'))
                <span class="form-error is-visible">{{$errors->first('type')}}</span>
            @endif
        {{-- /Type Combo box --}} 
            </div>
        </div>     
        
        <div class="grid-x grid-margin-x">
            <div class="cell medium-6">
        {{-- Start Date Combo box --}}
            <div class="input-group">
                <span class="input-group-label">
                    <i class="fa fa-calendar-plus-o"></i>
                </span>
                <input id="date_start" class="input-group-field dt_picker {{ $errors->has('date_start') ? ' is-invalid-input' : '' }}" name="date_start" value="{{ $event->date_start }}" type="text" placeholder="Starting date of event">
            </div>
            @if($errors->has('date_start'))
                <span class="form-error is-visible">{{$errors->first('date_start')}}</span>
            @endif
        {{-- /Start Date Combo box --}}
            </div>
        
            <div class="cell medium-6">
        {{-- Date End Combo  --}}
            <div class="input-group">
                <span class="input-group-label">
                    <i class="fa fa-calendar-minus-o"></i>
                </span>
                <input id="date_end" class="input-group-field dt_picker {{ $errors->has('date_end') ? ' is-invalid-input' : '' }}" name="date_end" value="{{ $event->date_end }}" type="text" placeholder="Ending date of event">
            </div>
            @if($errors->has('date_end'))
                <span class="form-error is-visible">{{$errors->first('date_end')}}</span>
            @endif
        {{-- /Date End Combo  --}}
            </div>
        </div>

        <div class="grid-x grid-margin-x">
            <div class="cell medium-6">
        {{-- Deadline Combo --}}
            <div class="input-group">
                <span class="input-group-label">
                    <i class="fa fa-calendar-times-o"></i>
                </span>
                <input id="deadline" class="input-group-field {{ $errors->has('deadline') ? ' is-invalid-input' : '' }}" name="deadline" value="{{ $event->deadline }}" type="text" placeholder="Deadline of event" onfocus="(this.type='date')" onblur="(this.type='text')">
            </div>
            @if($errors->has('deadline'))
                <span class="form-error is-visible">{{$errors->first('deadline')}}</span>
            @endif
        {{-- /Deadline Combo --}}
            </div>
        
            <div class="cell medium-6">
        {{-- Paid Event Status Checkbox --}}
            <div class="input-group radioBtnEdit">
                <?php $paid_activity=$event->paid_activity ?>    
                @if( $paid_activity == 1)
                    <input id="paid_activity" name="paid_activity" type="checkbox" checked>
                @else
                    <input id="paid_activity" name="paid_activity" type="checkbox">
                @endif                
                <label for="paid_activity">Paid activity of Event </label>
            </div>    
        {{-- /Paid Event Status Checkbox --}}     
            </div>
        </div>
        <br>
        {{-- Add Event Button --}}
            <button class="button expanded btnUpdate">Update Event</button>
        {{-- /Add Event Button --}}
    </form>
</div>

</fieldset>

    </div>
</div>
    <script>
        $(function(){
            window.prettyPrint && prettyPrint();
            $('.dt_picker').fdatetimepicker({
                format: 'yyyy-mm-dd hh:ii:ss'
            });			
        });
    </script>
    @section('contentscript')
        <script>
            function changeInputField()
            {
                $(".custom-file-upload").css("background-color", "#6BA34D");
            }
        </script>
    @endsection

    @if($errors->has('image_path'))
        <script>
            $.alert({
                title: 'Errors',
                icon: 'fas fa-exclamation',
                type: 'orange',
                boxWidth: '30%',
                useBootstrap: false,
                content: '<b>{{$errors->first('image_path')}}</b> Retry!' +
                '<hr>',
                });
        </script> 
    @endif
@endsection


