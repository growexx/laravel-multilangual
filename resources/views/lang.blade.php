<!DOCTYPE html>
<html>

<head>
    <title>How to Create Multi Language Website in Laravel</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>{{ $data["title"] }}</h1>
        <div class="row">
            <div class="col-md-2 col-md-offset-6 text-right">
                <strong>Select Language: </strong>
            </div>
            <div class="col-md-4">
                <select class="form-control changeLang">
                    <option value="en" {{ session()->get('to_lang') == 'en' ? 'selected' : '' }}>English</option>
                    <option value="fr" {{ session()->get('to_lang') == 'fr' ? 'selected' : '' }}>French</option>
                    <option value="sp" {{ session()->get('to_lang') == 'sp' ? 'selected' : '' }}>Spanish</option>
                    <option value="de" {{ session()->get('to_lang') == 'de' ? 'selected' : '' }}>German</option>
                    <option value="it" {{ session()->get('to_lang') == 'it' ? 'selected' : '' }}>Italian</option>
                    <option value="hi" {{ session()->get('to_lang') == 'hi' ? 'selected' : '' }}>हिन्दी</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <a class="btn btn-success" href="{{ route('companies.create') }}">{{ $data["create"] }}</a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-bordered">
            <tr>
                <th>{{ $data["table_row_1"] }}</th>
                <th>{{ $data["table_row_2"] }}</th>
                <th>{{ $data["table_row_3"] }}</th>
                <th>{{ $data["table_row_4"] }}</th>
                <th width="280px">{{ $data["table_row_5"] }}</th>
            </tr>
            @foreach ($companies as $company)
                <tr>
                    <td>{{ $company["id"] }}</td>
                    <td>{{ $company["name"] }}</td>
                    <td>{{ $company["email"] }}</td>
                    <td>{{ $company["address"] }}</td>
                    <td>
                        <form action="{{ route('companies.destroy', $company["id"]) }}" method="Post">
                            <a class="btn btn-primary" href="{{ route('companies.edit', $company["id"]) }}">{{ $data["edit"] }}</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">{{ $data["delete"] }}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</body>

<script type="text/javascript">
    var url = "{{ route('changeLang') }}";
    $(".changeLang").change(function() {
        window.location.href = url + "?lang=" + $(this).val();
    });
</script>

</html>
