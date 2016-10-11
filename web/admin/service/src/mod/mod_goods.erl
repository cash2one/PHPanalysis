%%%-------------------------------------------------------------------
%%% @author liuwei <>
%%% @copyright (C) 2010, liuwei
%%% @doc
%%%
%%% @end
%%% Created :11 Nov 2010 by liuwei <>
%%%-------------------------------------------------------------------
-module(mod_goods).

-include("erlang_web.hrl").

%% API
-export([
		 get/3
		]).

%%赠送物品
get("/send_goods/", Req, _DocRoot) ->
	do_send_goods(Req);
get(Path, Req, DocRoot) ->
	?ERROR_MSG("~ts : ~w ~w", ["未知的请求", Path, DocRoot]),
	mod_tool:return_json_error(Req).

do_send_goods(Req) ->
	Get = Req:parse_qs(),
	RoleID = proplists:get_value("role_id", Get),
	RoleName = proplists:get_value("role_name", Get),
	Type = proplists:get_value("type", Get),
	TypeID = proplists:get_value("typeid", Get),
	Number = proplists:get_value("number", Get),
	Bind = proplists:get_value("bind", Get),
	
	RoleID2 = common_tool:to_integer(RoleID),
	RoleName2 = common_tool:to_binary(RoleName),
	Type2 = common_tool:to_integer(Type),
	TypeID2 = common_tool:to_integer(TypeID),
	Number2 = common_tool:to_integer(Number),
	
	%% 是否是绑定的
	case Bind of
		"1" -> 
			Bind2 = true;
		_ -> 
			Bind2 = false
	end,
	case gen_server:call({global, mgeew_admin_server}, {admin_role, {send_goods, account, RoleID2, RoleName2, TypeID2, Type2, Number2, Bind2}}) of
		ok ->
			mod_tool:return_json_ok(Req);
		_ ->
			mod_tool:return_json_error(Req)
	end.