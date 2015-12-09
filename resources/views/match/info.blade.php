@extends('layouts.app')
@section('styles')
    <link href="{{ asset('css/match.css') }}" rel="stylesheet" type="text/css" />
@stop
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
                @foreach($data['picks_bans'] as $t => $team)
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
                <td colspan="14">
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
            <tr>
                <td colspan="14">
                    杀:{{$team['total']['k']}},  死:{{ $team['total']['d'] }}, 钱:{{ $team['total']['gold'] }}, 对英雄伤害:{{ $team['total']['hdmg'] }}, 对塔伤害:{{ $team['total']['tdmg'] }}, 治疗:{{ $team['total']['heal'] }}
                </td>
            </tr>
            <tr class="thead">
                <td class="left" colspan="2">
                    玩家
                </td>
                <td class="left" colspan="2">
                    英雄/等级
                </td>
                <td>
                    KDA<br/>
                    K/D/A
                </td>
                <td>Gold</td>
                <td>正/反补</td>
                <td>金钱/分钟</td>
                <td>经验/分钟</td>
                <td class="left">物品</td>
            </tr>
            @for($i =0 ;$i<=4;$i++)
            @if($i%2==0)
                <tr class="slot odd">
            @else
                <tr class="slot even">
            @endif
                    <td class="left">
                        @if($team[$i]['account_id'] != $data['anonymous'])
                        <a href="{{ $players[$team[$i]['steam_id']]->get('profileurl') }}"><img class="avatar" src=" {{ $players[$team[$i]['steam_id']]->get('avatar') }} " alt="{{ $players[$team[$i]['steam_id']]->get('personaname') }}"></a>
                        @endif
                    </td>
                    <td class="left">
                        @if($team[$i]['account_id'] != $data['anonymous'])
                        <a href="{{ $players[$team[$i]['steam_id']]->get('profileurl') }}">{{ $players[$team[$i]['steam_id']]->get('personaname') }}</a>
                        @else
                        匿名
                        @endif
                    </td>
                    <td><img src="{{ $heroes->getImgUrlById($team[$i]['hero_id']) }}" alt="" /></td>
                    <td class="left"><strong>{{ $heroes->getFieldById($team[$i]['hero_id'], 'dname') }}/{{ $team[$i]['level'] }}</strong></td>
                    <td>{{ $team[$i]['kda'] }}<br/>
                        {{ $team[$i]['k'] }}/{{ $team[$i]['d'] }}/{{ $team[$i]['a'] }}
                    </td>
                    <td>{{ $team[$i]['gold'] }}k</td>
                    <td>{{ $team[$i]['lh'] }}/{{ $team[$i]['dn'] }}</td>
                    <td>{{ $team[$i]['gpm'] }}</td>
                    <td>{{ $team[$i]['xpm'] }}</td>
                    <td class="left">
                        @for($j=0;$j<=5;$j++)
                            @if ($team[$i]['item_'.$j]!=$data['empty_item_id'])
                            <img src="{{ $items->getImgUrlById($team[$i]['item_'.$j]) }}" alt="" title="{{$items->getFieldById($team[$i]['item_'.$j],'dname')}}" />
                            @endif
                        @endfor
                    </td>
                </tr>
                <tr class="slot even ?>">
                    <td></td>
                    <td class="left abilities" colspan="13">
                        @foreach($team[$i]['abilities'] as $a_u)
                            <img class="ability" width="33" height="33" src="{{ $abilities->getImgUrlById($a_u['ability']) }}" title="{{ ucwords(str_replace('_', ' ', $abilities->getFieldById($a_u['ability'], 'name'))).' Time: '.gmdate('H:i:s', $a_u['time']).' Level: '.$a_u['level'] }}" />
                        @endforeach
                    </td>
                </tr>
            @endfor

            @endforeach
        </table>
    </div>

@stop