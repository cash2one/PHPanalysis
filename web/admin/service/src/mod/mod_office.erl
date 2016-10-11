%%%-------------------------------------------------------------------
%%% @author QingliangCn <>
%%% @copyright (C) 2010, QingliangCn
%%% @doc
%%% Created : 22 Oct 2010 by QingliangCn <>
%%%-------------------------------------------------------------------
-module(mod_office).

%% API
-export([get/3]).

-include("erlang_web.hrl").

get("/set_king/", Req, _DocRoot) ->
    do_set_king(Req);
get(_, Req, _DocRoot) ->
    Req:not_found().


%% 访问形式: /event/office/set_king/?role_id
do_set_king(Req) ->
    case global:whereis_name(mgeew_office) of
        undefined ->
            mod_tool:process_not_run(Req);
        PID ->
            Get = Req:parse_qs(),
            RoleName = proplists:get_value("role_name", Get),
            case gen_server:call(PID, {set_king, common_tool:to_list(RoleName)}) of
                ok ->
                    mod_tool:return_json_ok(Req);
                Error ->
                    ?ERROR_MSG("~p", [Error]),
                    mod_tool:return_json_error(Req)
            end
    end.
