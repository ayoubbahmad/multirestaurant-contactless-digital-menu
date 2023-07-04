@if($notification!=NULL)

            <div class="card">
                <div class="modal fade " id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true" >
                    <div class="modal-dialog modal-dialog-centered modal-" role="document">
                        <div class="modal-content" style="background-color: white; border-radius: 15px;">
                            <div class="modal-header" style="border: 0">
                                <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="py-3 text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                                    <h4 class="heading mt-4">{{$notification['head']}}</h4>
                                    <p>{{$notification['sub_head']}}</p>
                                </div>
                            </div>
                            <div class="modal-footer">

                                <button type="button" class="btn btn-white" data-dismiss="modal" ><i class="flaticon-cancel-12"></i> Close</button>
                                <button type="button" onclick="document.getElementById('action-form').submit();" class="btn btn-success  ml-auto ">{{$notification['route_submit_button_name']}}</button>
                            </div>
                            <form method="get" id="action-form" action="{{$notification['route'] !=NULL ?route($notification['route']):NULL}}"/>
                        </div>
                    </div>
                </div>
            </div>
@endif
