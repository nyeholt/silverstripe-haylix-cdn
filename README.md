# Haylix CDN 

A module that provides a Haylix cdn connector for the content-services module

## Usage

Add configuration as follows to your mysite/\_config/haylix.yml file


	---
	Name: localsettings
	After: contentservices
	---
	
	Injector:
	  HaylixService:
	    class: CloudStorage
	    constructor:
	      - accountName
	      - username
	      - key
	  HaylixContentWriter:
	    type: prototype
	    properties: 
	      haylix: %$HaylixService
	  HaylixContentReader:
	    type: prototype
	    properties:
	      haylix: %$HaylixService
	  ContentService:
	    properties:
	      stores:
	        File:
	          ContentReader: FileContentReader
	          ContentWriter: FileContentWriter
	        Haylix:
	          ContentReader: HaylixContentReader
          ContentWriter: HaylixContentWriter



