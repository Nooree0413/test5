@extends('layouts.adminfound')
@section("contentcss")
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/form-icons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/multi-select.css')}}">
    <link rel="icon" href="{{asset('images/addEvent.png')}}" />
    

    <title>Add Event</title>
@endsection


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
        <fieldset class="addEventFieldset">
    <legend class="addEventLegend">Add Event</legend>

    <div class="cell small-11 eventFormContainer">
    <form method="POST" action="{{route('user.addEvent')}}" enctype="multipart/form-data" class="cssAddEvent" data-abide autocomplete="off"> 
      @csrf
        {{-- Event Name Form field --}}
                <div class="input-group">
                    <span class="input-group-label">
                    <i class="fa fa-bookmark"></i>
                    </span>
                    <input class="input-group-field {{ $errors->has('txtename') ? ' is-invalid-input' : '' }}" name="txtename" value="{{ old('txtename') }}" type="text" placeholder="Event name" >
            {{-- Image Form Field --}}
                    <div class="input-group-button">
                        <label for="image_path" data-tooltip tabindex="2" title="Add an Event Image" class="custom-file-upload top" id="lblimg">
                            <i class="fa fa-image"></i>
                        </label>
                        <input  id="image_path" onchange="changeInputField()"class="button" type="file" name="image_path" >
                    </div>
                </div>
            {{-- /Image Form Field --}}
            @if($errors->has('txtename'))
                <span class="form-error is-visible">{{$errors->first('txtename')}}</span>
            @endif
        {{-- /Event Name Form field --}}
           
        {{-- Event Description Textarea --}}
            <div class="input-group">
                <span class="input-group-label">
                <i class="fa fa-book"></i>
            </span>
                <textarea class="input-group-field {{ $errors->has('description') ? ' is-invalid-input' : '' }}" name="description" type="text" placeholder="Description of event" >{{ old('description') }}</textarea>
            </div>
            @if($errors->has('description'))
                <span class="form-error is-visible">{{$errors->first('description')}}</span>
            @endif
        {{-- /Event Description Textarea --}}
              
        {{-- Start Date Combo box --}}
            <div class="grid-x grid-margin-x">
                <div class="cell medium-6">
                <div class="input-group">
                    <span class="input-group-label">
                        <i class="fa fa-calendar-plus-o"></i>
                    </span>
                    <input id="date_start" class="input-group-field dt_picker {{ $errors->has('date_start') ? ' is-invalid-input' : '' }}" name="date_start" value="{{ old('date_start') }}" type="text" placeholder="Starting date of event">
                </div>
                @if($errors->has('date_start'))
                    <span class="form-error is-visible">{{$errors->first('date_start')}}</span>
                @endif
            </div>
        {{-- /Start Date Combo box --}}
             
        {{-- Date End Combo  --}}
            <div class="cell medium-6">
                <div class="input-group">
                    <span class="input-group-label">
                        <i class="fa fa-calendar-minus-o"></i>
                    </span>
                    <input id="date_end" class="input-group-field dt_picker {{ $errors->has('date_end') ? ' is-invalid-input' : '' }}" name="date_end" value="{{ old('date_end') }}" type="text" placeholder="Ending date of event" >
                </div>
                @if($errors->has('date_end'))
                    <span class="form-error is-visible">{{$errors->first('date_end')}}</span>
                @endif
                </div>
            </div>
        {{-- /Date End Combo  --}}
            
        {{-- Deadline Combo --}}
            <div class="grid-x grid-margin-x">
                <div class="cell medium-6">
                    <div class="input-group">
                        <span class="input-group-label">
                            <i class="fa fa-calendar-times-o"></i>
                        </span>
                        <input id="deadline" class="input-group-field {{ $errors->has('deadline') ? ' is-invalid-input' : '' }}" name="deadline" value="{{ old('deadline') }}" type="text" placeholder="Deadline of event" onfocus="(this.type='date')" onblur="(this.type='text')" >
                    </div>
                    @if($errors->has('deadline'))
                        <span class="form-error is-visible">{{$errors->first('deadline')}}</span>
                    @endif
            </div>
        {{-- /Deadline Combo --}}

        {{-- Type Combo --}}
            <div class="cell medium-4">
                <div class="input-group">
                    <span class="input-group-label">
                        <i class="fa fa-plus-circle"></i>
                    </span>
                    <select id="type" class="input-group-field {{ $errors->has('type') ? ' is-invalid-input' : '' }}" name="type" >
                        <option selected disabled value="">Choose type</option>
                        @foreach ($type as $event_type)
                            <option value="{{$event_type->id}}">{{$event_type->type}}</option>
                        @endforeach
                    </select>
                    <div class="input-group-button">
                        <button class="button" id="btnadditem" name="btnadditem" type="button"><i class="fas fa-plus-square"></i></button>
                    </div>
                </div>
                
                @if($errors->has('type'))
                    <span class="form-error is-visible">{{$errors->first('type')}}</span>
                @endif
            </div>
        {{-- Type Combo --}}
            
        {{-- Paid Event Status Checkbox --}}
            <div class="cell medium-2">
                <div class="input-group radioBtn">
                    <input id="paid_activity" name="paid_activity" value="1" type="checkbox"><label for="paid_activity">Paid activity</label>
                </div>    
            </div>
        </div>
        {{-- /Paid Event Status Checkbox --}}     
            
        {{-- Add Event Button --}}
            <button class="button expanded btnAdd btnAddEventAlert eventform_btn">Add Event</button>
        {{-- /Add Event Button --}}

        {{-- Model to add item--}}
        <div class="reveal" id="additemmod" data-reveal>
            <div class="grid-x">
                <div class="cell">
                    <h3>Select Items</h3>
                </div>
            </div>
            <div class="grid-x item-menu">
                <div class="cell small-2"></div>
                <div class="cell small-8">
                    <select multiple="multiple" id="menu-select" name="menu-select[]">
                        @foreach ($items as $item)
                            <option value="{{$item->id}}">{{$item->item_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="grid-x">
                <div class="cell btnsavitem-div">
                    <button data-close id="btnaddMenu" name="btnaddMenu" type="button" class="button hvr-icon-push"><i class="fas fa-plus hvr-icon"></i> Save to Event </button>
                </div>
            </div>
            <button class="close-button" data-close aria-label="Close modal" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        {{-- Model to add item --}}
        {{-- Hidden Field to store menu --}}
        <input type="hidden" name="hfmenu" id="hfmenu">
    </form>
</div>
</fieldset> 
       
</div>
<div class="cell small-1"></div>
</div>
    @section('contentscript')
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

        <script>    
        $(document).ready(function()
        {
            $("#btnadditem").hide();
            $('#menu-select').multiSelect();
        });

        $('select[name=type]').change(function(e) {
            var type_id = e.target.value;
            //console.log(type_id);
            $.get('/check-type/'+type_id, function(data)
            {
            //success data
            data.forEach(function (d) 
            {
                if(d.order_status == 1)
                {
                    $("#btnadditem").show();
                }
                else
                {
                    $("#btnadditem").hide();
                }
                //console.log(d.order_status);
            });
                // console.log(data);
            });

            $("#btnadditem").on("click", function()
            {
                var popup = new Foundation.Reveal($('#additemmod'));
                popup.open();
            });
    
            $('#additemmod').on('closed.zf.reveal', function () {
                var menu = $("#menu-select").val();
                var menu_json = JSON.stringify(menu);
                $("#hfmenu").val(menu_json);
                //console.log(menu_json);
            });
            });
        
        $(function(){
            window.prettyPrint && prettyPrint();
            $('.dt_picker').fdatetimepicker({
                format: 'yyyy-mm-dd hh:ii:ss'
            });			
        });   
        </script>
        <script src="{{asset('js/jquery.multi-select.js')}}"></script>
    @endsection
@endsection


