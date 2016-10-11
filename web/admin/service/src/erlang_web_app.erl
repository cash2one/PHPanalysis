%% @author author <author@example.com>
%% @copyright YYYY author.

%% @doc Callbacks for the erlang_web application.

-module(erlang_web_app).
-author('author <author@example.com>').

-behaviour(application).
-export([start/2, stop/1]).


%% @spec start(_Type, _StartArgs) -> ServerRet
%% @doc application start callback for erlang_web.
start(_Type, _StartArgs) ->
	erlang_web_deps:ensure(),
	{ok, SupPid} = erlang_web_sup:start_link(),
	lists:foreach(
	  fun ({Msg, Thunk}) ->
			   io:format("starting ~-32s ...", [Msg]),
			   Thunk(),
			   io:format("done~n");
		 ({Msg, M, F, A}) ->
			  io:format("starting ~-20s ...", [Msg]),
			  apply(M, F, A),
			  io:format("done~n")
	  end,
	  [
	   {"erlang_web - Logger",
            fun() ->
                    {ok, LogPath} = application:get_env(log_path),
                    error_logger:add_report_handler(common_logger_h, LogPath),
                    {ok, LogLevel} = application:get_env(log_level),
                    common_loglevel:set(LogLevel)
            end},
           {"Write File",
            fun() ->
                    file:write_file("/data/mccq/server/ebin/erlang_web/run.lock", "started")
            end}
	  ]
         ), 
    {ok, SupPid}.

%% @spec stop(_State) -> ServerRet
%% @doc application stop callback for erlang_web.
stop(_State) ->
	file:delete_file("/data/mccq/server/ebin/erlang_web/run.lock"),
    ok.


%%
%% Tests
%%
-include_lib("eunit/include/eunit.hrl").
-ifdef(TEST).
-endif.
