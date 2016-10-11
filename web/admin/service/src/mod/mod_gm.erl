-module(mod_gm).
-include("erlang_web.hrl").
%% API
-export([
         get/3
        ]).

get("/gm_modify_title/", Req, _DocRoot) ->
    do_modify_title(Req);
get("/gm_modify_achieve/", Req, _DocRoot) ->
	do_modify_achieve(Req);
get("/get_ban_role/", Req, _DocRoot) ->
	do_get_ban_role(Req);
get("/get_ban_ip/", Req, _DocRoot) ->
	do_get_ban_ip(Req);
get("/ban_role/", Req, _DocRoot) ->
	do_ban_role(Req);
get("/ban_ip/", Req, _DocRoot) ->
	do_ban_ip(Req);
get("/dis_ban_role/", Req, _DocRoot) ->
	do_dis_ban_role(Req);
get("/dis_ban_ip/", Req, _DocRoot) ->
	do_dis_ban_ip(Req);
get("/init_props/", Req, _DocRoot) ->
	do_init_props(Req);
get("/change_body/", Req, _DocRoot) ->
	do_change_body(Req);
get("/init_mission/", Req, _DocRoot) ->
	do_init_mission(Req);
get("/open_match/", Req, _DocRoot) ->
	do_open_match(Req);
get("/close_match/", Req, _DocRoot) ->
	do_close_match(Req);
get("/stop_match/", Req, _DocRoot) ->
	do_stop_match(Req);
get("/set_open_time/", Req, _DocRoot) ->
	do_set_open_time(Req);
get("/open_mount_match/", Req, _DocRoot) ->
	do_open_mount_match(Req);
get("/close_mount_match/", Req, _DocRoot) ->
	do_close_mount_match(Req);
get("/set_open_mount_time/", Req, _DocRoot) ->
	do_set_open_mount_time(Req);
get(Path, Req, DocRoot) ->
    ?ERROR_MSG("~ts : ~w ~w", ["未知的请求", Path, DocRoot]),
    mod_tool:return_json_error(Req).

%%修改称号
do_modify_title(Req) ->
	Get = Req:parse_qs(),
	RoleID = proplists:get_value("role_id", Get),
	RoleName = proplists:get_value("role_name", Get),
	TitleName = proplists:get_value("title_name", Get),
	
	RoleID2 = common_tool:to_integer(RoleID),
	
	case gen_server:call({global, mgeew_admin_server}, {admin_role, {gm_modify_title, account, RoleID2, RoleName, TitleName}}) of
		ok ->
			mod_tool:return_json_ok(Req);
		_ ->
			mod_tool:return_json_error(Req)
	
	end.

%%修改成就
do_modify_achieve(Req) ->
	Get = Req:parse_qs(),
	RoleID = proplists:get_value("role_id", Get),
	RoleName = proplists:get_value("role_name", Get),
	AchieveID = proplists:get_value("achieve_id", Get),
	
	RoleID2 = common_tool:to_integer(RoleID),
	AchieveID2 = common_tool:to_integer(AchieveID),
	
	case gen_server:call({global, mgeew_admin_server}, {admin_role, {gm_modify_achieve, account, RoleID2, RoleName, AchieveID2}}) of
		ok ->
			mod_tool:return_json_ok(Req);
		_ ->
			mod_tool:return_json_error(Req)
	
	end.

%%获取封禁角色
do_get_ban_role(Req) ->
	BanRoleList = db:dirty_match_object(?DB_BAN_USER, #r_ban_user{_='_'}),
	List = 
		lists:foldr(fun(RoleList, Acc) ->
							#r_ban_user{rolename=RoleName, deadline=DeadLine, adminid=AdminId}=RoleList,
							Temp = [{obj,[{rolename,common_tool:to_binary(RoleName)},{deadline, DeadLine},{adminid, AdminId}]}],
							Acc ++ Temp
					end, [], lists:append(BanRoleList, [])),
	J = lists:flatten(rfc4627:encode(List)),
	Req:ok({"text/html; charset=utf-8", [{"Server","Mochiweb-Test"}],J}).

%%获取封禁ip
do_get_ban_ip(Req) ->
	BanIpList = db:dirty_match_object(?DB_BAN_IP, #r_ban_ip{_='_'}),
	List = 
		lists:foldr(fun(IpList, Acc) ->
							#r_ban_ip{ip=IP, deadline=DeadLine, adminid=AdminId}=IpList,
							IP2 = common_tool:to_binary(inet_parse:ntoa(IP)),
							Temp = [{obj, [{ip, IP2}, {deadline, DeadLine}, {adminid, AdminId}]}],
							Acc ++ Temp
					end, [], lists:append(BanIpList, [])),
	J = lists:flatten(rfc4627:encode(List)),
	Req:ok({"text/html; charset=utf-8", [{"Server","Mochiweb-Test"}],J}).

%%封禁角色
do_ban_role(Req) ->
	Get = Req:parse_qs(),
	AccountName = proplists:get_value("role_name", Get),
	Time = proplists:get_value("ban_time", Get),
	AdminId = proplists:get_value("admin_id", Get),
	
	AccountName2 = common_tool:to_binary(AccountName),
	DeadLine = common_tool:now() + common_tool:to_integer(Time),
	AdminId2 = common_tool:to_integer(AdminId),
	
	case db:dirty_match_object(?DB_ROLE_BASE, #p_role_base{account_name=AccountName2, _='_'}) of
		[#p_role_base{account_name=AccountName2}] ->
			AccountName3 = binary_to_list(AccountName2),
			Pattern = #r_ban_user{rolename=AccountName3, deadline=DeadLine, adminid=AdminId2},
			case db:dirty_match_object(?DB_BAN_USER, #r_ban_user{rolename=AccountName3, _='_'}) of
				%%角色已封禁，先解禁再封禁
				[#r_ban_user{rolename=AccountName3}] ->
					db:dirty_delete(?DB_BAN_USER,AccountName3),
					db:dirty_write(?DB_BAN_USER, Pattern),
					mod_tool:return_json_ok(Req);
				_ ->
					db:dirty_write(?DB_BAN_USER, Pattern),
					mod_tool:return_json_ok(Req)
			end;
		%%角色不存在
		_ ->
			mod_tool:return_json_error(Req)
	end.

%%封禁ip
do_ban_ip(Req) ->
	Get = Req:parse_qs(),
	IP = proplists:get_value("ip", Get),
	Time = proplists:get_value("ban_time", Get),
	AdminId = proplists:get_value("admin_id", Get),
	
	IpList = string:tokens(IP, "."),
	RealIp = get_to_integer(IpList, []),
	IP2 = list_to_tuple(RealIp),
	
	DeadLine = common_tool:now() + common_tool:to_integer(Time),
	AdminId2 = common_tool:to_integer(AdminId),
	
	Pattern = #r_ban_ip{ip=IP2, deadline=DeadLine, adminid=AdminId2},
	case db:dirty_match_object(?DB_BAN_IP, #r_ban_ip{ip=IP2, _='_'}) of
		%%IP已被封禁，先解禁再封禁
		[#r_ban_ip{ip=IP2}] ->
			db:dirty_delete(?DB_BAN_IP, IP2),
			db:dirty_write(?DB_BAN_IP, Pattern),
			mod_tool:return_json_ok(Req);
		_ ->
			db:dirty_write(?DB_BAN_IP, Pattern),
			mod_tool:return_json_ok(Req)
	end.

%%解封角色
do_dis_ban_role(Req) -> 
	Get = Req:parse_qs(),
	AccountName = proplists:get_value("role_name", Get),
	
	case db:dirty_match_object(?DB_BAN_USER, #r_ban_user{rolename=AccountName, _='_'}) of
		[#r_ban_user{rolename=AccountName}] ->
			db:dirty_delete(?DB_BAN_USER, AccountName),
			mod_tool:return_json_ok(Req);
		_ ->
			mod_tool:return_json_error(Req)
	end.

%%解封ip
do_dis_ban_ip(Req) -> 
	Get = Req:parse_qs(),
	IP = proplists:get_value("ip", Get),
	IpList = string:tokens(IP, "."),
	RealIp = get_to_integer(IpList, []),
	IP2 = list_to_tuple(RealIp),
	
	case db:dirty_match_object(?DB_BAN_IP, #r_ban_ip{ip=IP2, _='_'}) of
		[#r_ban_ip{ip=IP2}] ->
			db:dirty_delete(?DB_BAN_IP, IP2),
			mod_tool:return_json_ok(Req);
		_ ->
			mod_tool:return_json_error(Req)
	end.
	
%%解析IP地址
get_to_integer([], IntList) ->
	lists:reverse(IntList);
get_to_integer([H|T], IntList) ->
	{Ele, _} = string:to_integer(H),
	get_to_integer(T, [Ele|IntList]).

%%初始化玩家属性
do_init_props(Req) ->
	Get = Req:parse_qs(),
	RoleName = proplists:get_value("role_name", Get),
	case gen_server:call({global, mgeew_admin_server}, {admin_role, {init_props, account, RoleName}}) of
		ok ->
			mod_tool:return_json_ok(Req);
		_ ->
			mod_tool:return_json_error(Req)
	end.

%%清除变身状态
do_change_body(Req) ->
	Get = Req:parse_qs(),
	RoleName = proplists:get_value("role_name", Get),
	case gen_server:call({global, mgeew_admin_server}, {admin_role, {gm_change_body, account, RoleName}}) of
		ok ->
			mod_tool:return_json_ok(Req);
		_ ->
			mod_tool:return_json_error(Req)
	end.

%%删除异常任务
do_init_mission(Req) ->
	Get = Req:parse_qs(),
	RoleName  = proplists:get_value("role_name", Get),
	MissionID = proplists:get_value("mission_id", Get),
	
	case gen_server:call({global, mgeew_admin_server}, {admin_role, {init_mission, account, RoleName, MissionID}}) of
		ok ->
			mod_tool:return_json_ok(Req);
		_ ->
			mod_tool:return_json_error(Req)
	end.

%%开启竞技场
do_open_match(Req) ->
	case gen_server:call({global, mgeew_admin_server}, {admin_role, {open_match, account}}) of
		ok ->
			mod_tool:return_json_ok(Req);
		_ ->
			mod_tool:return_json_error(Req)
	end.

%%关闭竞技场
do_close_match(Req) -> 
	case gen_server:call({global, mgeew_admin_server}, {admin_role, {close_match, account}}) of
		ok ->
			mod_tool:return_json_ok(Req);
		_ ->
			mod_tool:return_json_error(Req)
	end.

%%强制结束比赛
do_stop_match(Req) -> 
	case gen_server:call({global, mgeew_admin_server}, {admin_role, {stop_match, account}}) of
		ok ->
			mod_tool:return_json_ok(Req);
		_ ->
			mod_tool:return_json_error(Req)
	end.

%%设置竞技场开启时间
do_set_open_time(Req) -> 
	Get = Req:parse_qs(),
	OpenTime = proplists:get_value("open_time", Get),
	OpenTime2 = common_tool:to_integer(OpenTime),
	case gen_server:call({global, mgeew_admin_server}, {admin_role, {set_open_time, account, OpenTime2}}) of
		ok ->
			mod_tool:return_json_ok(Req);
		_ ->
			mod_tool:return_json_error(Req)
	end.

do_open_mount_match(Req) ->
	case gen_server:call({global, mgeew_admin_server}, {admin_role, {open_mount_match, account}}) of
		ok ->
			mod_tool:return_json_ok(Req);
		_ ->
			mod_tool:return_json_error(Req)
	end.

do_close_mount_match(Req) ->
	case gen_server:call({global, mgeew_admin_server}, {admin_role, {close_mount_match, account}}) of
		ok ->
			mod_tool:return_json_ok(Req);
		_ ->
			mod_tool:return_json_error(Req)
	end.

do_set_open_mount_time(Req) ->
	Get = Req:parse_qs(),
	OpenTime = proplists:get_value("open_time", Get),
	OpenTime2 = common_tool:to_integer(OpenTime),
	case gen_server:call({global, mgeew_admin_server}, {admin_role, {set_open_mount_time, account, OpenTime2}}) of
		ok ->
			mod_tool:return_json_ok(Req);
		_ ->
			mod_tool:return_json_error(Req)
	end.
		