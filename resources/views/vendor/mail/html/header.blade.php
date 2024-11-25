@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <a class="navbar-brand logo" style="
                font-family: 'Arial Black', Arial, sans-serif;
                font-size: 2rem;
                font-weight: bold;
                color: #2A73E8;
                letter-spacing: 2px;
                text-transform: uppercase;
                background: linear-gradient(90deg, #2A73E8, #32CD32);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                display: inline-block;
                text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3); "
                   href="{{ route("index") }}">
                    EDUVERIFIED
                </a>
            @else
                <a class="navbar-brand logo" style="
                font-family: 'Arial Black', Arial, sans-serif;
                font-size: 2rem;
                font-weight: bold;
                color: #2A73E8;
                letter-spacing: 2px;
                text-transform: uppercase;
                background: linear-gradient(90deg, #2A73E8, #32CD32);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                display: inline-block;
                text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3); "
                   href="{{ route("index") }}">
                    EDUVERIFIED
                </a>
            @endif
        </a>
    </td>
</tr>
