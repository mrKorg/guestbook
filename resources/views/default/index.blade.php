@extends("layouts.layout")

@section("messages")

    <table id="products_table"
           data-toggle="table"
           data-show-refresh="false"
           data-show-toggle="false"
           data-show-columns="false"
           data-search="true"
           data-select-item-name="toolbar1[]"
           data-pagination="true"
           data-page-size="10"
           data-page-list="[5, 10, 25, 50, 100, 200]"
           data-sort-name="name"
           data-sort-order="asc">
        <thead>
            <tr>
                <th data-field="login" data-sortable="true">User name</th>
                <th data-field="email" data-sortable="true">Email</th>
                <th data-field="message" data-sortable="false">Message</th>
                <th data-field="created_at" data-sortable="true">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($message_list as $message)
            <tr>
                <td>
                    @if($message->url)
                        <a href="{{ $message->url }}" target="_blank">{{ $message->login }}</a>
                    @else
                        {{ $message->login }}
                    @endif
                </td>
                <td class="email"><strong><a href="mailto:{{ $message->email }}" target="_blank">{{ $message->email }}</a></strong></td>
                <td>{!! $message->message !!}</td>
                <td class="date"><strong>{{ $message->created_at }}</strong></td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection

@section("form")

    <form class="form-signin row" method="post" action="" enctype="multipart/form-data" id="send-form">

        {{ csrf_field() }}

        @if(is_array($alert) && count($alert) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($alert as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @elseif(is_string($alert) && $alert != '')
            <div class="alert alert-success">
                {{ $alert }}
            </div>
        @endif

        <div class="col-xs-12 col-md-4">
            <label for="inputName">Name</label>
            <input name="user_name" type="text" id="inputName" class="form-control" placeholder="Name" autofocus="" value="{{ old('user_name') }}">

            <label for="inputEmail">Email address</label>
            <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Your email" value="{{ old('email') }}">

            <label for="inputUrl">Home page</label>
            <input name="url" type="url" id="inputUrl" class="form-control" placeholder="Url" value="{{ old('url') }}">

            {{--<label for="inputFile">Avatar</label>--}}
            {{--<input name="img" type="file" id="inputFile" class="form-control">--}}

            <div class="form-group">
                <label>Капча&#160;&#160;</label>
                <div style="margin-bottom: 5px;">
                    <img src="{{ captcha_src() }}" alt="captcha" class="captcha-img" data-refresh-config="default">
                    &#160;&#160;
                    <a href="#" id="refresh"><span class="glyphicon glyphicon-refresh"></span></a>
                </div>
                <input name="captcha" type="text" id="inputCaptcha" class="form-control">
            </div>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Send message</button>
        </div>
        <div class="col-xs-12 col-md-8">
            <label for="inputMsg">Message</label>
            <textarea name="message" id="inputMsg" class="form-control" cols="30" rows="10" placeholder="Your text message">{{ old('message') }}</textarea>
        </div>
    </form>

@endsection