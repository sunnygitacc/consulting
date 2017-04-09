<?Php $time=time();

 ?>

<style>
	body {
		margin: 0;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#calendar {
		width: 96%;
		margin: 40px auto;
                background-color: #fff;
                padding :6px;
	}
</style>

	<div id='calendar' >  </div>


<div id="dialog" title="Events">
<form id='popup' name='popup'>
<table>
<tr>
<td>Title<br/>
<textarea id='title' >

</textarea>
</td>
</tr>
<!--
<tr>
<td>Url<br/>
<input type='url' id='url' name='url'>
</td>
</tr>
-->
<tr>
<td>Text Color<br/>
<input type='color' id='color' name='text_color'>
</td>
</tr>
<!--
<tr>
<td>Title<br/>
<textarea id='desc' >

</textarea>
</td>
</tr>
-->
<tr>
<td>
<button id="add_event">Add Event</button>

<button id="update_event">Update Event</button>
<button id="delete_event">Delete</button>

</td>
</td>
</tr>
<tr>
<td class='hideme' >start<span id='start' ></span>end<span id='end' ></span><input type='text' name='event_id' id='event_id'></td>
</tr>
</table>
</form>
</div>

