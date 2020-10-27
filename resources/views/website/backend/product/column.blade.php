
<a href="{!! $editUrl !!}" class="btn btn-primary" role="button" aria-pressed="true">Update</a>

<form  action="{!! $deleteUrl !!}" method="POST" class="float-left">
	<input type="hidden" name="_method" value="delete">
	@method('DELETE')
	@csrf                                              
		<button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete')">Delete</button>
</form>	