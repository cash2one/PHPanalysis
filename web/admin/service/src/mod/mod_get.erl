%%%-------------------------------------------------------------------
%%% @author QingliangCn <>
%%% @copyright (C) 2010, QingliangCn
%%% @doc
%%%
%%% @end
%%% Created : 21 Oct 2010 by QingliangCn <>
%%%-------------------------------------------------------------------
-module(mod_get).

-include("erlang_web.hrl").

%% API
-export([
         handle/3
        ]).

%%处理
handle(Path, Req, DocRoot) ->
    ?DEBUG("~ts:~s ~p ~s", ["Web访问", Path, Req, DocRoot]),
    get(Path, Req, DocRoot).



%%实际的get处理
get(?WEB_MODULE_BASEINFO ++ _Remain, Req, _DocRoot) ->
    Rtn = mod_game:get_baseinfo(),
    Result = lists:flatten(rfc4627:encode({obj, Rtn})),
    ?DEBUG("~ts,Result=~w",["查询基本信息返回结果为",Result]),
    Req:ok({"text/html; charset=utf-8", [{"Server","Mochiweb-Test"}],Result})  ;
get(?WEB_MODULE_NODES, Req, _DocRoot) ->
    Rtn = mod_game:get_nodes(),
    Result = lists:flatten(rfc4627:encode({obj, Rtn})),
    Req:ok({"text/html; charset=utf-8", [{"Server","Mochiweb-Test"}],Result});
get("map_members",Req,_DocRoot)->
	mod_game:get_map_members(Req);
get(?WEB_MODULE_USER, Req, _DocRoot) ->
	QueryString = Req:parse_qs(),
	Fun = proplists:get_value("fun", QueryString),
	Arg = proplists:get_value("arg", QueryString),
	Ip = proplists:get_value("ip", QueryString),
	?DEBUG("~ts：~ts",["调用的函数为",Fun]),
	Rtn = case Fun of
			  "getUseridByUsername"->
				  mod_user:get_userid_by_username(Arg);
			  "getUseridByAccountName"->
				  mod_user:get_userid_by_accountname(Arg);
			  "createAccountPassWebpage" ->
				  mod_user:create_account_pass_web(Arg,Ip);
			  "checkAccountPassWebpage" ->
				  mod_user:check_account_pass_web(Arg)
		  end,
	Result = lists:flatten(rfc4627:encode({obj, common_tool:to_list(Rtn)})),
	?DEBUG("~ts",[Result]),
	Req:ok({"text/html; charset=utf-8", [{"Server","Mochiweb-Test"}],Result});
get(?WEB_MODULE_SERVER, Req, _) ->
    Version = erlang:system_info(otp_release),
    Result = lists:flatten(rfc4627:encode({obj, [{"erlang_version", common_tool:to_binary(Version)}]})),
    Req:ok({"text/html; charset=utf-8", [{"Server","Mochiweb-Test"}],Result});
get(?WEB_MODULE_EVENT ++ RemainPath, Req, DocRoot) ->
    mod_event:get(RemainPath, Req, DocRoot);
get(?WEB_MODULE_API ++ RemainPath, Req, DocRoot) ->
    mod_api:get(RemainPath, Req, DocRoot);
get(?WEB_MODULE_BROADCAST ++ RemainPath, Req, DocRoot) ->
    mod_broadcast:handle(RemainPath, Req, DocRoot);
get("pay" ++ RemainPath, Req, DocRoot) ->
    mod_pay:get(RemainPath, Req, DocRoot);
get("goods" ++ RemainPath, Req, DocRoot) ->
    mod_goods:get(RemainPath, Req, DocRoot);
get("email" ++ RemainPath, Req, DocRoot) ->
    mod_email:get(RemainPath, Req, DocRoot);
get("usermsg" ++ RemainPath, Req, DocRoot) ->
    mod_user:get_user_data(RemainPath, Req, DocRoot);
get("killuser" ++ RemainPath, Req, DocRoot) ->
    mod_user:do_kill_role_admin(RemainPath, Req, DocRoot);
get("gm" ++ RemainPath, Req, DocRoot) ->
	mod_gm:get(RemainPath, Req, DocRoot);

get(_, Req, _) ->
    Req:not_found().

