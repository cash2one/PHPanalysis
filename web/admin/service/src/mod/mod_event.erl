%%%-------------------------------------------------------------------
%%% @author QingliangCn <>
%%% @copyright (C) 2010, QingliangCn
%%% @doc
%%%
%%% @end
%%% Created : 22 Oct 2010 by QingliangCn <>
%%%-------------------------------------------------------------------
-module(mod_event).

%% API
-export([
         get/3
        ]).


get("/warofking" ++ RemainPath, Req, DocRoot) ->
    mod_event_warofking:get(RemainPath, Req, DocRoot);
get("/waroffaction" ++ RemainPath, Req, DocRoot) ->
    mod_event_waroffaction:get(RemainPath, Req, DocRoot);
get("/office" ++ RemainPath, Req, DocRoot) ->
    mod_office:get(RemainPath, Req, DocRoot);
get(_RemainPath, Req, _DocRoot) ->
    Req:not_found().
