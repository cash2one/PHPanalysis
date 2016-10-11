-module(mod_pay).

-export([get/3]).

-include("erlang_web.hrl").


%%赠送元宝
get("/send_gold/", Req, _DocRoot) ->
    do_send_gold(Req);
%%赠送银两
get("/send_silver/", Req, _DocRoot) ->
    do_send_silver(Req);
get(Path, Req, DocRoot) ->
    ?ERROR_MSG("~ts : ~w ~w", ["未知的请求", Path, DocRoot]),
    mod_tool:return_json_error(Req).


do_send_gold(Req) ->
    Get = Req:parse_qs(),
	RoleID = proplists:get_value("role_id", Get),
	RoleName = proplists:get_value("role_name", Get),
    Number = proplists:get_value("number", Get),
    Reason = proplists:get_value("reason", Get),
    Type = proplists:get_value("type", Get),
    Bind = proplists:get_value("bind", Get),
	
    Number2 = common_tool:to_integer(Number),
	RoleID2 = common_tool:to_integer(RoleID),
    
    %% 是否是绑定的
    case Bind of
        "1" ->
            Bind2 = true;
        _ ->
            Bind2 = false
    end,
    case Type of
        "account" ->
            case gen_server:call({global, mgeew_admin_server}, {admin_role, {send_gold, account, RoleID2, RoleName, Number2, Bind2, Reason}}) of
                ok ->
                    mod_tool:return_json_ok(Req);
				_ ->
                    mod_tool:return_json_error(Req)
            end;
        _ ->
            mod_tool:return_json_error(Req)
    end.

do_send_silver(Req) ->
    Get = Req:parse_qs(),
	RoleID = proplists:get_value("role_id", Get),
	RoleName = proplists:get_value("role_name", Get),
    Number = proplists:get_value("number", Get),
    Reason = proplists:get_value("reason", Get),
    Type = proplists:get_value("type", Get),

    Number2 = common_tool:to_integer(Number),
	RoleID2 = common_tool:to_integer(RoleID),
    
    case Type of
        "account" ->
            case gen_server:call({global, mgeew_admin_server}, {admin_role, {send_silver, account, RoleID2, RoleName, Number2, Reason}}) of
                ok ->
                    mod_tool:return_json_ok(Req);
                _ ->
                    mod_tool:return_json_error(Req)
            end;
        _ ->
            mod_tool:return_json_error(Req)
    end.
