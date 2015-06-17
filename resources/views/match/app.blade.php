<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Match info</title>
        <link href="{{ asset('css/global.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/global-chinese.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/heropedia.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/match.css') }}" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="bodyContainer">
            <div id="centerColOuter_NoCallout">
                <div id="centerColTopShadow"><img src="http://media.steampowered.com/apps/dota2/images/heropedia/centercolbox_top_shadow.png" width="984" height="25" alt="" /></div>
                <div id="centerColTop"><img src="http://media.steampowered.com/apps/dota2/images/heropedia/centercolbox_top.png" width="984" height="9" alt="" /></div>
                <div id="centerColContainer">
                    <div id="centerColContent">
                        <div class="redboxOuter"style="margin: 0 auto;">
                            <div class="redboxContent">
                                <div class="redboxTop"></div>
                                <div id="heroPickerInner">
                                    <!-- OUR CODE WILL BE THERE -->
                                    @yield('content')
                                </div>
                                <div class="redboxBottom"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="centerColBottom"><img src="http://media.steampowered.com/apps/dota2/images/heropedia/centercolbox_bottom.png" width="984" height="9" alt="" /></div>
                <div id="centerColBottomShadow"><img src="http://media.steampowered.com/apps/dota2/images/heropedia/centercolbox_bottom_shadow.png" width="984" height="25" alt="" /></div>
            </div>
        </div>
    </body>
</html>