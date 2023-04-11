<!DOCTYPE html>
<html lang="en-US">

<div style="margin:3rem; text-align: center;">
    <h3> Start the challenge now! </h3>
    @if (Auth::guard(session('role'))->user())
        <a href="/modules/challenges/start" class="btn cartoonish-btn">Start now</a>
    @else
        <a href="/login/student" class="btn cartoonish-btn">Login to start</a>
    @endif
</div>