[![Telegram](https://img.shields.io/badge/Telegram-PresentKim-blue.svg?logo=telegram)](https://t.me/PresentKim)

[![icon/192x192](meta/icon/192x192.png?raw=true)]()

[![License](https://img.shields.io/github/license/PMMPPlugin/GeometryAPI.svg?label=License)](LICENSE)
[![Poggit](https://poggit.pmmp.io/ci.shield/PMMPPlugin/GeometryAPI/GeometryAPI)](https://poggit.pmmp.io/ci/PMMPPlugin/GeometryAPI)
[![Release](https://img.shields.io/github/release/PMMPPlugin/GeometryAPI.svg?label=Release)](https://github.com/PMMPPlugin/GeometryAPI/releases/latest)
[![Download](https://img.shields.io/github/downloads/PMMPPlugin/GeometryAPI/total.svg?label=Download)](https://github.com/PMMPPlugin/GeometryAPI/releases/latest)


A plugin skin data api for PocketMine-MP

## Command
Main command : `/geometry <list | lang | reload | save>`

| subcommand | arguments              | description                 |
| ---------- | ---------------------- | --------------------------- |
| List       | \[page\]               | Show geometry list          |
| Lang       | \<language prefix\>    | Load default lang file      |
| Reload     |                        | Reload all data             |
| Save       |                        | Save all data               |




## Permission
| permission          | default  | description        |
| ------------------- | -------- | ------------------ |
| geometry.cmd        | OP       | main command       |
|                     |          |                    |
| geometry.cmd.list   | OP       | list subcommand    |
| geometry.cmd.lang   | OP       | lang subcommand    |
| geometry.cmd.reload | OP       | reload subcommand  |
| geometry.cmd.save   | OP       | save subcommand    |




## ChangeLog
### v1.0.0 [![Source](https://img.shields.io/badge/source-v1.0.0-blue.png?label=source)](https://github.com/PMMPPlugin/GeometryAPI/tree/v1.0.0) [![Release](https://img.shields.io/github/downloads/PMMPPlugin/GeometryAPI/v1.0.0/total.png?label=download&colorB=1fadad)](https://github.com/PMMPPlugin/GeometryAPI/releases/v1.0.0)
- First release
### v1.0.1 [![Source](https://img.shields.io/badge/source-v1.0.1-blue.png?label=source)](https://github.com/PMMPPlugin/GeometryAPI/tree/v1.0.0) [![Release](https://img.shields.io/github/downloads/PMMPPlugin/GeometryAPI/v1.0.1/total.png?label=download&colorB=1fadad)](https://github.com/PMMPPlugin/GeometryAPI/releases/v1.0.1)
- \[Fixed\] getGeometryData() return bool