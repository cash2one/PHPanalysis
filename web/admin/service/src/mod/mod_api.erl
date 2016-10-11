%%%-------------------------------------------------------------------
%%% @author QingliangCn <>
%%% @copyright (C) 2010, QingliangCn
%%% @doc
%%%
%%% @end
%%% Created : 28 Oct 2010 by QingliangCn <>
%%%-------------------------------------------------------------------
-module(mod_api).

-export([get/3]).

-include("erlang_web.hrl").


%%正常的充值接口
get("/pay/", Req, _DocRoot) ->
    do_pay(Req);
get(Path, Req, DocRoot) ->
    ?ERROR_MSG("~ts : ~w ~w", ["未知的请求", Path, DocRoot]),
    mod_tool:return_json_error(Req).


%%正常的充值接口
do_pay(Req) ->
	Get = Req:parse_qs(),
	OrderID = proplists:get_value("order_id", Get),
%% 	RoleName = proplists:get_value("role_name", Get),
	AcName = proplists:get_value("ac_name", Get),
	PayGold = common_tool:to_integer(proplists:get_value("pay_gold", Get)),
	PayTime = common_tool:to_integer(proplists:get_value("pay_time", Get)),
	PayMoney = common_tool:to_integer(proplists:get_value("pay_money", Get)),
	Year = common_tool:to_integer(proplists:get_value("year", Get)),
	Month = common_tool:to_integer(proplists:get_value("month", Get)),
	Day = common_tool:to_integer(proplists:get_value("day", Get)),
	Hour = common_tool:to_integer(proplists:get_value("hour", Get)),
	%timer:sleep(1500),
	%?ERROR_MSG("~p", [Get]),
	case global:whereis_name(mgeew_pay_server) of
		undefined ->
			?ERROR_MSG("~ts", ["充值进程没有启动，world可能down了"]),
			mod_tool:return_json_error(Req);
		PID ->
			Rtn = gen_server:call(PID, {pay, OrderID, AcName, PayTime, PayGold, PayMoney, {Year, Month, Day, Hour}}),
			Result = lists:flatten(rfc4627:encode({obj, common_tool:to_list(Rtn)})),
			Req:ok({"text/html; charset=utf-8", [{"Server","Mochiweb-Test"}],Result})
	end.
    
    

