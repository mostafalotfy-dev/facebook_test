<div class="table-responsive">
    <table class="table" id="cheifs-table">
        <thead>
        <tr>
            <th>@lang('models/cheifs.fields.name')</th>
        <th>@lang('models/cheifs.fields.phone_number')</th>
        <th>@lang('models/cheifs.fields.email')</th>
        <th>@lang('models/cheifs.fields.phone_number_verified_at')</th>
        <th>@lang('models/cheifs.fields.password')</th>
        <th>@lang('models/cheifs.fields.avatar')</th>
        <th>@lang('models/cheifs.fields.provider_id')</th>
        <th>@lang('models/cheifs.fields.provider_token')</th>
        <th>@lang('models/cheifs.fields.provider_name')</th>
        <th>@lang('models/cheifs.fields.identity')</th>
        <th>@lang('models/cheifs.fields.youtube_channel')</th>
        <th>@lang('models/cheifs.fields.facebook_link')</th>
        <th>@lang('models/cheifs.fields.description')</th>
        <th>@lang('models/cheifs.fields.user_ip')</th>
        <th>@lang('models/cheifs.fields.udid')</th>
        <th>@lang('models/cheifs.fields.remember_token')</th>
            <th colspan="3">@lang('crud.action')</th>
        </tr>
        </thead>
        <tbody>
         @foreach($cheifs as $cheif)
            <tr>
                <td>{{ $cheif->name }}</td>
            <td>{{ $cheif->phone_number }}</td>
            <td>{{ $cheif->email }}</td>
            <td>{{ $cheif->phone_number_verified_at }}</td>
            <td>{{ $cheif->password }}</td>
            <td>{{ $cheif->avatar }}</td>
            <td>{{ $cheif->provider_id }}</td>
            <td>{{ $cheif->provider_token }}</td>
            <td>{{ $cheif->provider_name }}</td>
            <td>{{ $cheif->identity }}</td>
            <td>{{ $cheif->youtube_channel }}</td>
            <td>{{ $cheif->facebook_link }}</td>
            <td>{{ $cheif->description }}</td>
            <td>{{ $cheif->user_ip }}</td>
            <td>{{ $cheif->udid }}</td>
            <td>{{ $cheif->remember_token }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['cheifs.destroy', $cheif->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('cheifs.show', [$cheif->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('cheifs.edit', [$cheif->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
         @endforeach
        </tbody>
    </table>
</div>
