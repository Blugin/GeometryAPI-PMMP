# <img src="https://rawgit.com/PresentKim/SVG-files/master/plugin-icons/geometryapi.svg" height="50" width="50"> GeometryAPI
__A plugin for [PMMP](https://pmmp.io) :: skin geometry data api__  
  
  
[![license](https://img.shields.io/github/license/organization/GeometryAPI-PMMP.svg?label=License)](LICENSE)
[![release](https://img.shields.io/github/release/organization/GeometryAPI-PMMP.svg?label=Release)](../../releases/latest)
[![download](https://img.shields.io/github/downloads/organization/GeometryAPI-PMMP/total.svg?label=Download)](../../releases/latest)
[![Build status](https://ci.appveyor.com/api/projects/status/cgncarehs1l8qgjy/branch/master?svg=true)](https://ci.appveyor.com/project/PresentKim/geometryapi-pmmp/branch/master)
  
## What is this?   
It is a skin geometry data API.
  
  
## Features  
- [x] Support configurable things  
- [x] Check that the plugin is not latest version  
  - [x] If not latest version, show latest release download url  
  
  
## Configurable things  
- [x] Configure the language for messages  
  - [x] in `{SELECTED LANG}/lang.ini` file  
  - [x] Select language in `config.yml` file  
- [x] Configure the command
  - [x] in `config.yml` file  
- [x] Configure the permission of command  
  - [x] in `config.yml` file  
- [x] Configure the whether the update is check (default "false")
  - [x] in `config.yml` file  
  
The configuration files is created when the plugin is enabled.  
The configuration files is loaded  when the plugin is enabled.  
  
  
## Command  
Main command : `/geometry [page]`  
  
  
## Permission  
| permission   | default | description   |  
| ------------ | ------- | ------------- |  
| geometry.cmd | OP      | main command  | 
