<a data-id="form{{$id}}" href="" class="badge btn-delete badge-danger not_export"><i style="font-size: 13px;" class="fa fa-trash"></i>Delete</a>
<form  id="form{{$id}}" action="{{$action}}" method="post">
@csrf
@method('delete')
</form>
