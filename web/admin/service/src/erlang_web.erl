%% @author author <author@example.com>
%% @copyright YYYY author.

%% @doc TEMPLATE.

-module(erlang_web).
-author('author <author@example.com>').
-export([start/0, stop/0]).

ensure_started(App) ->
    case application:start(App) of
        ok ->
            ok;
        {error, {already_started, App}} ->
            ok
    end.

%% @spec start() -> ok
%% @doc Start the erlang_web server.
start() ->
    erlang_web_deps:ensure(),
    ensure_started(crypto),
    application:start(erlang_web),
    mod_distribution:join_db_group().

%% @spec stop() -> ok
%% @doc Stop the erlang_web server.
stop() ->
    Res = application:stop(erlang_web),
    application:stop(crypto),
    Res.
