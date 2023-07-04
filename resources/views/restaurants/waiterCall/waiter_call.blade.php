@extends("restaurants.layouts.restaurants_layout")

@section("restaurant_content")

    <div class="container-fluid">

        <div class="row">

            @php $i=1 @endphp
            @foreach($calls as $data)

                <div class="col-md-4">
                    <div class="card shadow-lg">
                        <div class="card-header bg-secondary">
                            <div class="row">
                                <div class="col-8 text-white">{{ $data->customer_name }}</div>
                                <div class="col-4">
                                    @if($data->is_completed == 0)
                                        <a href="#" class="btn btn-sm btn-dark text-success float-end"
                                           onclick="document.getElementById('compete-waiter-{{$data->id}}').submit();">
                                            <i class="fas fa-mouse"></i>
                                        </a>
                                    @endif
                                    @if($data->is_completed == 1)
                                        <a class="text-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-check-circle">
                                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                            </svg>
                                        </a>
                                    @endif
                                    <form style="visibility: hidden" method="post"
                                          action="{{route('store_admin.update_waiter_call_status',['id'=>$data->id])}}"
                                          id="compete-waiter-{{$data->id}}">
                                        @csrf
                                        @method('patch')
                                        <input style="visibility:hidden" name="is_completed" type="hidden" value="1">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table>
                                <tbody>
                                <tr>
                                    <td>
                                        {{$selected_language->data['store_view_orders_customer_phone'] ?? 'Phone No'}} : {{ $data->customer_phone }}
                                    </td>
                                    {{-- <td class="text-right">{{ $data->customer_phone }}</td> --}}
                                </tr>
                                <tr>
                                    <td>
                                        {{$selected_language->data['store_orders_table_no'] ?? 'Table No'}}
                                        : {{ $data->table_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{$selected_language->data['store_view_waiter_call_comments'] ?? 'Comment.'}}
                                        : {{ $data->comment }}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            @endforeach


        </div>
    </div>



    <script language="javascript">
        setTimeout(function () {
            window.location.reload(1);
        }, 10000);
    </script>
@endsection
