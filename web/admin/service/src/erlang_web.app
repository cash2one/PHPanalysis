{application, erlang_web,
 [{description, "erlang_web"},
  {vsn, "0.01"},
  {modules, [
    erlang_web,
    erlang_web_app,
    erlang_web_sup,
    erlang_web_web,
    erlang_web_deps
  ]},
  {registered, []},
  {mod, {erlang_web_app, []}},
  {env, []},
  {applications, [kernel, stdlib, crypto]}]}.
