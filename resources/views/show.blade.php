<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $data['title'] }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <div class="container pt-3">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right pb-2">
                    <a class="btn btn-primary" href="{{ route('companies.index') }}">{{ $data['back_button'] }}</a>
                </div>
            </div>
        </div>
        <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>{{ $data['id'] }}:</strong> {{ $company['id'] }}
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>{{ $data['create_company_name'] }}:</strong> {{ $company['name'] }}
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>{{ $data['create_company_email'] }}:</strong> {{ $company['email'] }}
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>{{ $data['create_company_address'] }}:</strong> {{ $company['address'] }}
                    </div>
                </div>

            </div>
        </form>
</x-app-layout>
