<!DOCTYPE html>
<html lang="en-US">

<br> <br>
<h1 style="text-align: center;">User Progress</h1>
<br> <br>

<div id="verticalScroll">
	<div style="display:none"> {{$i=0}} </div>
	@foreach(App\Models\Module::all() as $module)
		<div style="margin:4rem">
			<h2 style="text-align: center; margin:2rem;">{{$module->name}}</h2>
			@foreach($module->getTopics as $topic)
			<div style="margin:1rem">
				<h5>{{$topic->name}}</h5>
				<div class="progress">
					<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="{{$progress[$i]}}" aria-valuemin="0" aria-valuemax="100" style="width:{{$progress[$i++] * 100 }}%">

					</div>
				</div>
			</div>
			@endforeach
		</div>
	@endforeach
</div>

<style>
	#verticalScroll {
		height: 600px;
		overflow: scroll;
	}
</style>