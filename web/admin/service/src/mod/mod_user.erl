%%%-------------------------------------------------------------------
%%% @author QingliangCn <>
%%% @copyright (C) 2010, QingliangCn
%%% @doc
%%%
%%% @end
%%% Created : 20 Oct 2010 by QingliangCn <>
%%%-------------------------------------------------------------------
-module(mod_user).
-include("/data/mge/hrl/common.hrl").

%% API
-export([
         get_userid_by_username/1,
         get_userid_by_accountname/1,
		 create_account_pass_web/2,
		 check_account_pass_web/1,
		 do_kill_role_admin/3,
		 get_user_data/3
        ]).

-define(DEBUG(Format, Args),common_logger:debug_msg("erlang_web", ?MODULE,?LINE,Format, Args)).

get_userid_by_username(UserName)->
	RoleId = common_misc:get_roleid(UserName),
	[{roleid,RoleId}].

get_userid_by_accountname(AccountName)->
	RoleId = common_misc:get_roleid_by_accountname(AccountName),
	[{roleid,RoleId}].

create_account_pass_web(AccountName,Ip) ->
	?DEBUG("start create account by web!",[]),
	Info = common_misc:register_account_by_web(AccountName,Ip),
	?DEBUG("create mod user account end ~w",[Info]),
	[{res,Info}].

check_account_pass_web(AccountName) ->
	?DEBUG("start check account by web!",[]),
	Flag = common_misc:check_name(AccountName),
	[{ok,Flag}].
get_user_data("/get_user_msg/", Req, DocRoot) ->
	?DEBUG("start get_user_msg! DocRoot:~w",[DocRoot]),
	Get = Req:parse_qs(),
    RoleId = proplists:get_value("role_id", Get),
    Username = proplists:get_value("username", Get),
    case gen_server:call({global, mgeew_admin_server}, {admin_role, {user_role, account,RoleId,Username}}) of
         {error, _} ->
             mod_tool:return_json_error(Req);
		 List ->
			 J = lists:flatten(rfc4627:encode(List)),
             Req:ok({"text/html; charset=utf-8", [{"Server","Mochiweb-Test"}],J})
    end.
do_kill_role_admin("/kill_user_role/", Req, _DocRoot) ->
	Get = Req:parse_qs(),
    RoleId = proplists:get_value("role_id", Get),
    case gen_server:call({global, mgeew_admin_server}, {admin_role, {kill_user_role, account,RoleId}}) of
         false ->
             mod_tool:return_json_error(Req);
		 ok ->
             mod_tool:return_json_ok(Req)
    end;
do_kill_role_admin("/kill_role_utill/", Req, _DocRoot) ->
	Get = Req:parse_qs(),
    RoleId = proplists:get_value("role_id", Get),
	Time = proplists:get_value("ban_time", Get),
    case gen_server:call({global, mgeew_admin_server}, {admin_role, {kill_role_utill, account,RoleId,Time}}) of
		ok ->
             mod_tool:return_json_ok(Req);
        _ ->
             mod_tool:return_json_error(Req)
    end;
do_kill_role_admin("/stop_chat/", Req, _DocRoot) ->
	Get = Req:parse_qs(),
    RoleID = proplists:get_value("role_id", Get),
	RoleId=common_tool:to_integer(RoleID),
	[RoleBase]=db:dirty_read(?DB_ROLE_BASE,RoleId),
	RoleName = RoleBase#p_role_base.role_name,
	ChatRolePName = common_misc:chat_get_role_pname(RoleName),
    case gen_server:call({global, ChatRolePName}, {stop_chat, account,RoleId}) of
         false ->
             mod_tool:return_json_error(Req);
		 ok ->
             mod_tool:return_json_ok(Req)
    end.