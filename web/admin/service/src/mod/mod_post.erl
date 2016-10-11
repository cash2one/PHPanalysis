%%%-------------------------------------------------------------------
%%% @author QingliangCn <>
%%% @copyright (C) 2010, QingliangCn
%%% @doc
%%%
%%% @end
%%% Created : 22 Oct 2010 by QingliangCn <>
%%%-------------------------------------------------------------------
-module(mod_post).

%% API
-export([handle/3]).

handle(Path, Req, DocRoot) ->
    post(Path, Req, DocRoot).


post(_, Req, _DocRoot) ->
    Req:not_found().
