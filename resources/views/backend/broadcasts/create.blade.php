@extends('layout.base')

@section("custom_css")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
<style>
    .select2-container--classic .select2-selection--multiple .select2-selection__choice {
        background-color: #5369f8;
        border: 1px solid #5369f8;
    }

    .select2-container--classic .select2-selection--multiple .select2-selection__choice__remove {
        color: #fff;
    }

</style>
@stop

@section('content')
<div class="container-fluid">

    <div class="row page-title align-items-center">
        <div class="col-sm-4 col-xl-6">
            <h4 class="mb-1 mt-0">Compose</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4 float-sm-left">Compose Message</h3>

                    <a href="{{ route('broadcast.index') }}" class="btn btn-primary float-right">
                        Go Back
                    </a>

                    @include('partials.alert.message')

                    <div class="row col-12">
                        <form action="{{ route('broadcast.store') }}" method="POST" class="col-12">
                            @csrf
                            <div class="form-group">
                                    <label>Store</label>
                                        <select class="form-control col-12" name="store" id="store" required>
                                            <option value="" selected disabled>None selected</option>
                                            <option value="">nnn</option>                                    
                                            <option value="">dokj</option>
                                        </select>
                            </div>
                            <div class="form-group">
                                <label >Customer(s)</label>
                                <select class="form-control jstags" multiple name="numbers[]">
                                    @foreach ($customers as $key => $value)
                                    <option value="{{$value}}">{{$key}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                    <label>Message</label>
                                        <select class="form-control col-12" name="store" id="msgselect" required>
                                            <option value="" selected disabled>None selected</option>
                                            <option value="Happy new year!">Happy new year!</option>
                                            <option value="We are now open!">We are now open!</option>
                                            <option value="New stocks just arrived!">New stocks just arrived!</option>
                                            <option value="Happy new Month">Happy new Month</option>
                                            <option value="Thank you for shopping with">Thank you for shopping with US!</option>
                                            <option value="other">Custom Message</option>
                                        </select>
                            </div>
                            <div class="form-group" id="txtarea">
                                <label for="exampleFormControlTextarea1">Your Custom Message</label>
                                <textarea class="form-control" rows="3"></textarea>
                            </div>
                            </div>
                            
                            <button class="btn btn-primary" type="submit">Send &nbsp;<i
                                    class="fa fa-paper-plane my-float"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("javascript")
<script src="https://code.jquery.com/jquery-1.8.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
 <!-- App js -->
    <script src="/backend/assets/js/app.min.js"></script>
    <script src="/backend/assets/js/alert.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(".jstags").select2({
        theme: "classic",
        tags: true,
    });
    
</script>
<script>
    $("#txtarea").hide();
    $( "#msgselect" ).change(function() {
    var val = $("#msgselect").val();
        if(val=="other"){
            $("#txtarea").show();
        } else {
                    $("#txtarea").hide();
        }
    });
</script>
@stop
