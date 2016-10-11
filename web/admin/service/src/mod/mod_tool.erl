%%%-------------------------------------------------------------------
%%% @author QingliangCn <>
%%% @copyright (C) 2010, QingliangCn
%%% @doc
%%%
%%% @end
%%% Created : 29 Oct 2010 by QingliangCn <>
%%%-------------------------------------------------------------------
-module(mod_tool).

-include("erlang_web.hrl").

%% API
-export([
         process_not_run/1,
         json/1,
         return_json/2,
         return_json_ok/1,
         return_json_error/1,
         now_nanosecond/0,
		 return_json_arr_ok/2
        ]).

json(List) ->
    lists:flatten(rfc4627:encode({obj, List})).


return_json(List, Req) ->
    Result = json(List),
    Req:ok({"text/html; charset=utf-8", [{"Server","Mochiweb-Test"}],Result}).

return_json_ok(Req) ->
    List = [{result, ok}],
    return_json(List, Req).

return_json_error(Req) ->
    List = [{result, error}],
    return_json(List, Req).
    

process_not_run(Req) ->
    List = [{result, error}],
    return_json(List, Req).

now_nanosecond() ->
    {A, B, C} = erlang:now(),
    A * 1000000000000 + B*1000000 + C.
return_json_arr_ok(Req,List) ->
    return_json(List, Req).