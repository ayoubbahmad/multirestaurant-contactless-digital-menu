
    <div class="card">
        <div class="modal fade active" id="modal-notification-order" tabindex="-1" role="dialog" aria-labelledby="modal-notification" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                <div class="modal-content" style="background-color: white; border-radius: 15px;">
                    <div class="modal-header" style="border: 0">
                        <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="py-3 text-center">
                            <i class="ni ni-bell-55 ni-3x"></i>
                            <h4 class="heading mt-4">NEW ORDER</h4>
                            <p id="order_id"></p>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-white " data-bs-dismiss="modal" id="stopSound1" >Close</button>
                        <a id="stopSound2" target="_blank" href="{{route('store_admin.orders')}}"  class="btn btn-primary ml-auto">View Order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <audio id="myAudio">
        <source src="http://127.0.0.1:8000/notification/2.mp3" type="audio/ogg">
        <source src="http://127.0.0.1:8000/notification/2.mp3" type="audio/mpeg">
    </audio>
    <script src={{asset("assets/js/lib/jquery.min.js")}}></script>
    <script>
        $(function() {
            let notification = document.createElement('audio');
            let notificationFileRoute = '{{asset('notification/2.mp3')}}';
            notification.setAttribute('src', notificationFileRoute);
            notification.setAttribute('type', 'audio/mp3');
            // notification.setAttribute('muted', 'muted');
            notification.setAttribute('loop', 'true');
            $("#stopSound").click(function(event) {notification.pause();notification.currentTime = 0;});
            $("#stopSound1").click(function(event) {notification.pause();notification.currentTime = 0;});
            $("#stopSound2").click(function(event) {
                notification.pause();notification.currentTime = 0;
                $("#modal-notification-order").modal("hide")
            });
            let newOrderCount = null
            setInterval(function() {
                $.ajax({
                    url: '{{route('store_admin.new_orders')}}',
                    type: 'GET',
                    dataType: 'json',
                    data: {listed_order_ids: [], _token: '{{csrf_token()}}'},
                }).done(function(newArray) {
                    {{--console.log({{$order_count}},newArray)--}}
                    let old_order = newOrderCount || {{$order_count}};
                    if (old_order != newArray.payload.count){
                        newOrderCount = newArray.payload.count
                        $("#modal-notification-order").modal("show")
                        console.log(newArray.payload.orders);
                        document.getElementById("order_id").innerHTML = newArray.payload.orders[0].order_unique_id
                            notification.play();
                    }
                })
            },  10*1000)
        })
    </script>

