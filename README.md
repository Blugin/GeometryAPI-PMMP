<img src="./assets/icon/index.svg" height="256" width="256">  

[![License](https://img.shields.io/github/license/PMMPPlugin/GeometryAPI.svg?label=License)](LICENSE)
[![Release](https://img.shields.io/github/release/PMMPPlugin/GeometryAPI.svg?label=Release)](https://github.com/PMMPPlugin/GeometryAPI/releases/latest)
[![Download](https://img.shields.io/github/downloads/PMMPPlugin/GeometryAPI/total.svg?label=Download)](https://github.com/PMMPPlugin/GeometryAPI/releases/latest)


A plugin skin geometry data api for PocketMine-MP

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
  
  
---
### v1.0.1 [![Source](https://img.shields.io/badge/source-v1.0.1-blue.png?label=source)](https://github.com/PMMPPlugin/GeometryAPI/tree/v1.0.1) [![Release](https://img.shields.io/github/downloads/PMMPPlugin/GeometryAPI/v1.0.1/total.png?label=download&colorB=1fadad)](https://github.com/PMMPPlugin/GeometryAPI/releases/v1.0.1)
- \[Fixed\] getGeometryData() return bool
  
  
---
### v1.0.2 [![Source](https://img.shields.io/badge/source-v1.0.2-blue.png?label=source)](https://github.com/PMMPPlugin/GeometryAPI/tree/v1.0.2) [![Release](https://img.shields.io/github/downloads/PMMPPlugin/GeometryAPI/v1.0.2/total.png?label=download&colorB=1fadad)](https://github.com/PMMPPlugin/GeometryAPI/releases/v1.0.2)
- \[Fixed\] Violation of PSR-0
- \[Added\] Add PluginCommand getter and setter
- \[Added\] Add getters and setters to SubCommand
- \[Fixed\] Add api 3.0.0-ALPHA11
- \[Added\] Add website and description
- \[Changed\] Show only subcommands that sender have permission to use
