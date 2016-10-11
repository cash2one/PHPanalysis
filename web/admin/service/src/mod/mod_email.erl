%%%-------------------------------------------------------------------
%%% @author liuwei <>
%%% @copyright (C) 2010, liuwei
%%% @doc
%%%
%%% @end
%%% Created : 11 Nov 2010 by liuwei <>
%%%-------------------------------------------------------------------
-module(mod_email).

-include("erlang_web.hrl").

%% API
-export([
         get/3
        ]).


%%发送信件
get("/send_email/", Req, _DocRoot) ->
    do_send_email(Req);
get(Path, Req, DocRoot) ->
    ?ERROR_MSG("~ts : ~w ~w", ["未知的请求", Path, DocRoot]),
    mod_tool:return_json_error(Req).

do_send_email(Req) ->
    Get = Req:parse_qs(),
	RoleIdList = proplists:get_value("role_id", Get),
    RoleNameList = proplists:get_value("role_name", Get),
	Content = proplists:get_value("content", Get),
	
	RoleIdList2 = get_id_list(RoleIdList),
	RoleNameList2 = get_id_list(RoleNameList),
	    
    case gen_server:call({global, mgeew_admin_server}, {admin_role, {send_email, account, RoleIdList2, RoleNameList2, Content}}) of
        ok ->
            mod_tool:return_json_ok(Req);
        _ ->
            mod_tool:return_json_error(Req)
    end.

get_id_list([]) ->
	[];
get_id_list(L) ->
	get_id_list(L, [], []).

get_id_list([H|T], ID, IdList)->
	case H of
		%%逗号分隔符
		44 ->
			get_id_list(T, [], [lists:reverse(ID)|IdList]);
		_ ->
			get_id_list(T, [H|ID], IdList)			
	end;
get_id_list([], ID, IdList) ->
	[lists:reverse(ID)|IdList].