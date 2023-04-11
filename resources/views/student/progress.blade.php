<!DOCTYPE html>
<html lang="en-US">

<br><br>
<h1 style="text-align: center;">User Progress</h1>
<br>
<div id="verticalScroll">
	<div style="display:none">{{ $i=0 }}</div>
	@foreach (App\Models\Module::take(3)->get() as $module)
	<div style="margin: 2rem;">
		<h2 style="text-align: center; margin: 2rem;">{{ ucwords(str_replace('-', ' ', $module->name)) }}</h2>
		@foreach ($module->getTopics as $topic)
		<div style="margin-bottom: 1rem;">
			<h5>{{ $topic->name }}</h5>
			<div class="progress" style="height: 1.5rem;">
				<div class="progress-bar bg-success progress-bar-striped active" role="progressbar" aria-valuenow="{{ $progress[$i] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $progress[$i++] * 100 }}%;">
					{{ number_format($progress[$i - 1], 2, '.', ',') }}%
				</div>
			</div>
			@endforeach
		</div>
	@endforeach
</div>

<style>
	#verticalScroll {
		height: 600px;
		overflow: auto;
	}

	.progress-bar {
		font-size: 1rem;
	}
</style>