@extends('backend.layout.master')

@section('element')
    <div class="card">
        <div class="card-body">
            <div id="container1">



                <style>
                    .centt {
                        margin-left: 20px;
                        display: block;
                    }

                    .feat {
                        padding: 5px;
                        #font-weight: bold;
                        color: #21a9e1;

                    }

                    .pamms {
                        background: whitesmoke;
                        border: 1px solid red;
                        padding: 7px;
                    }

                    .upline {
                        color: #21a9e1 !important;
                        font-weight: bold;
                    }

                    .feat2 {
                        color: #21a9e1 !important;
                        font-weight: bold;
                    }
                </style> <br>

                <!--- level 2 --->

                @foreach ($user->refferals as $ref)
                    <div class="pamms"><i class="las la-arrow-up"
                            style="font-size:35px;color:#21a9e1;margin:22px;margin-left: 20%;"></i><!--<img class="centt" width='20px' src='<i class='entypo-up-bold' style='font-size:35px;color:#21a9e1;margin:22px;margin-left: 20%;'></i>'> --><br><br>
                        <span class="upline">Upline (<span style="border-bottom:2px dotted #009fe0;font-weight:bold">2nd -
                                3%</span>) : </span>
                        <span class="feat">Name : </span><span class="feat2">{{ $ref->username }} (</span><span
                            class="feat">Email: </span><span class="feat2">{{ $ref->email }}) - </span><span
                            class="feat">ID :</span>
                        <strong><span class="feat2">2678</span><span class="feat">WALLET ACC = </span></strong>
                    </div>
                @endforeach

                <!--- level 1 --->
                {{-- <div class="pamms"><i class="las la-arrow-up"
                        style="font-size:35px;color:#21a9e1;margin:22px;margin-left: 20%;"></i><!--<img class="centt" width='20px' src='<i class='entypo-up-bold' style='font-size:35px;color:#21a9e1;margin:22px;margin-left: 20%;'></i>'> --><br><br>
                    <span class="upline">Upline (<span style="border-bottom:2px dotted #009fe0;font-weight:bold">1st -
                            5%</span>) : </span>
                    <span class="feat">Name : </span><span class="feat2">Indika Thushara (</span><span
                        class="feat">Email: </span><span class="feat2">bprenandu@gmail.com) - </span><span
                        class="feat">ID :</span>
                    <strong><span class="feat2">2697</span><span class="feat">WALLET ACC = </span></strong>
                </div> --}}
                <div class="pamms">
                    <br> <br><br><br>
                    <span class="upline"><b>Current user : </b><br></span>
                    <span class="feat" style="margin-left:75px;">Name : </span><span class="feat2">{{ $user->username }}
                    </span>
                    <span class="feat">- Email: </span><span class="feat2">{{ $user->email }}- </span>
                    <span class="feat">ID :</span><span class="feat2">2835 </span><br>
                    <br>
                    <span class="feat" style="margin-left:75px;">Management ACC : </span>
                    &nbsp;&nbsp;
                    <span class="feat2">NONE </span>&nbsp;&nbsp;
                    <button class="btn btn-danger btn-icon btn-sm" disabled="" type="button"
                        onclick="openACC(2835)">OPEN MANAGEMENT ACC <i class="entypo-check"></i></button>&nbsp;

                    <br>
                    <br><span class="feat" style="margin-left:75px;">Balance : </span><span
                        class="feat2">{{ $user->balance }}</span>
                    <br><br><br>
                    <button class="btn btn-danger btn-icon btn-sm" disabled="" type="button"
                        onclick="confirmTransaction(2835,274)">APPROVE<i class="entypo-check"></i></button>&nbsp;

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
