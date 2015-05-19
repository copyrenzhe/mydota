@extends('match.app')

@section('content')
    <h3>比赛 # {{ $match->get('match_id') }}
    (
        @if($match->get('radiant_win'))
        天辉
        @else
        夜魇
        @endif
        获胜
    )
    </h3>
    <div class="common-stats">
        <p>Game Mode - {{ $mods->getFieldById($match->get('game_mode'), 'name') }}</p>
        <p>Region - {{ $regions->getFieldById($match->get('cluster'), 'name') }}</p>
        <p>Start Time - {{ gmdate('d M Y, H:i:s', strtotime($match->get('start_time'))) }}</p>
        <p>Lobby Type - {{ $lobbies->getFieldById($match->get('lobby_type'), 'name') }}</p>
        <p>Duration - {{ gmdate('H:i:s', $match->get('duration')) }}</p>
        <p>First Blood Time - {{ gmdate('i:s', $match->get('first_blood_time')) }}</p>
    </div>
    @if($data['captains'])
    <div style="float:right;">
        <h2>Picks and Bans</h2>
        <table class="picks_bans">
            <tr>
                <td style="vertical-align: top;">Bans:<br /><br />Picks:</td>
                @foreach($picks_bans as $t => $team)
                    <td>
                    @foreach($team as $k_s=>$state)
                        @foreach($state as $pick_ban)
                            <img src="{{ $heroes->getImgUrlById($pick_ban['hero_id']) }}" alt="" />
                        @endforeach
                        <br/>
                        <br/>
                    @endforeach
                    </td>
                @endforeach
            </tr>
        </table>
    </div>
    @endif
    <div class="slots-wrapper">
        <table class="slots">
            @foreach($data['detail'] as $k=> $team)
            <tr>
                <td colsapn="14">
                    <h2>
                        @if($k=='radiant')
                        天辉
                        @else
                        夜魇
                        @endif
                        @if(!is_null($match->get($k.'_name')))
                        ({{ $match->get($k.'_name') }})
                        @endif
                    </h2>
                </td>
            </tr>
            <tr class="thead">
                <td class="left" colspan="2">
                    玩家
                </td>
                <td class="left" colspan="2">
                    英雄/等级
                </td>
                <td>K</td>
                <td>D</td>
                <td>A</td>
                <td>Gold</td>
                <td>LH</td>
                <td>DN</td>
                <td>GPM</td>
                <td>XPM</td>
                <td class="left">Items</td>
            </tr>
            @foreach($team as $key => $slot)
            @if($key%2==0)
                <tr class="slot odd">
            @else
                <tr class="slot odd">
            @endif
                    <td class="left">
                        @if($slot['account_id'] != $data['anonymous'])
                        <a href="{{ $players[$steam_id]->get('profileurl') }}"><img class="avatar" src=" {{ $players[$steam_id]->get('avatar') }} " alt="{{ $players[$steam_id]->get('personaname') }}"></a>
                        @endif
                    </td>
                    <tr class="left">
                        @if($slot['account_id'] != $data['anonymous'])
                        <a href="{{ $players[$steam_id]->get('profileurl') }}">{{ $players[$steam_id]->get('personaname') }}</a>
                        @else
                        匿名
                        @endif
                    </tr>
                    <td><img src="{{ $heroes->get_img_url_by_id($slot->get('hero_id')) }}" alt="" /></td>
                    <td class="left"><strong>{{ $heroes->get_field_by_id($slot->get('hero_id'), 'localized_name') }}</strong></td>
                    <td>{{ $slot['level'] }}</td>
                    <td>{{ $slot['kills'] }}</td>
                    <td>{{ $slot['deaths'] }}</td>
                    <td>{{ $slot['assists'] }}</td>
                    <td>{{ $slot['gold'] }}k</td>
                    <td>{{ $slot['last_hits'] }}</td>
                    <td>{{ $slot['denies'] }}</td>
                    <td>{{ $slot['gold_per_min'] }}</td>
                    <td>{{ $slot['xp_per_min'] }}</td>
                    <td class="left">
                        @for($i=0;$i<=5;$i++)
                            @if ($slot['item_'.$i]!=$data['empty_item_id'])
                            <img src="{{ $items->getImgUrlById($slot['item_'.$i]) }}" alt="" />
                            @endif
                        @endfor
                    </td>
                </tr>
            @endforeach
            @endforeach
        </table>
    </div>

@stop