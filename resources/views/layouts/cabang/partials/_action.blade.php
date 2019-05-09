{!! Form::model($model, ['url' => $delete_url, 'method' => 'DELETE']) !!}
    <a href="{{ $show_url }}" class="btn btn-sm btn-outline-info" style="padding-bottom: 0px; padding-top: 0px;">
        Tampilkan
        <span class="btn-label btn-label-right"><i class="fa fa-eye"></i></span>
    </a>
    <a href="{{ $edit_url }}" class="btn btn-sm btn-outline-secondary" style="padding-bottom: 0px; padding-top: 0px;">
        Ubah
        <span class="btn-label btn-label-right"><i class="fa fa-edit"></i></span>
    </a>
    <button  
        type="submit" class="btn btn-sm btn-outline-danger" 
        style="padding-bottom: 0px; padding-top: 0px;"
        onclick="return confirm('Are you sure you want to delete this item?');">
        Hapus
        <span class="btn-label btn-label-right"><i class="fa fa-trash"></i></span>
    </button>
{!! Form::close() !!}