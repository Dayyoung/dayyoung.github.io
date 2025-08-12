
gdjs.evtsExt__ScoreCounter__ScoreCounter = gdjs.evtsExt__ScoreCounter__ScoreCounter || {};

/**
 * Object generated from Animated Score Counter
 */
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter = class ScoreCounter extends gdjs.CustomRuntimeObject2D {
  constructor(parentInstanceContainer, objectData) {
    super(parentInstanceContainer, objectData);
    this._parentInstanceContainer = parentInstanceContainer;

    this._onceTriggers = new gdjs.OnceTriggers();
    this._objectData = {};
    
    this._objectData.Score = objectData.content.Score !== undefined ? objectData.content.Score : Number("0") || 0;
    

    // It calls the onCreated super implementation at the end.
    this.onCreated();
  }

  // Hot-reload:
  updateFromObjectData(oldObjectData, newObjectData) {
    super.updateFromObjectData(oldObjectData, newObjectData);
    if (oldObjectData.content.Score !== newObjectData.content.Score)
      this._objectData.Score = newObjectData.content.Score;

    this.onHotReloading(this._parentInstanceContainer);
    return true;
  }

  // Properties:
  
  _getScore() {
    return this._objectData.Score !== undefined ? this._objectData.Score : Number("0") || 0;
  }
  _setScore(newValue) {
    this._objectData.Score = newValue;
  }

  

  
}

// Methods:
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.onCreatedContext = {};
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.onCreatedContext.GDObjectObjects1= [];
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.onCreatedContext.GDObjectObjects2= [];
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.onCreatedContext.GDIconObjects1= [];
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.onCreatedContext.GDIconObjects2= [];
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.onCreatedContext.GDCounterObjects1= [];
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.onCreatedContext.GDCounterObjects2= [];
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.onCreatedContext.GDBackgroundObjects1= [];
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.onCreatedContext.GDBackgroundObjects2= [];


gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.onCreatedContext.eventsList0 = function(runtimeScene, eventsFunctionContext) {

{


let isConditionTrue_0 = false;
{
gdjs.copyArray(eventsFunctionContext.getObjects("Counter"), gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.onCreatedContext.GDCounterObjects1);
{for(var i = 0, len = gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.onCreatedContext.GDCounterObjects1.length ;i < len;++i) {
    gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.onCreatedContext.GDCounterObjects1[i].getBehavior(eventsFunctionContext.getBehaviorName("Text")).setText(("" + eventsFunctionContext.getObjects("Object")[0]._getScore()));
}
}}

}


};

gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.onCreated = function(parentEventsFunctionContext) {

var that = this;
var runtimeScene = this._instanceContainer;
var thisObjectList = [this];
var Object = Hashtable.newFrom({Object: thisObjectList});
var thisGDIconObjectsList = [...runtimeScene.getObjects("Icon")];
var GDIconObjects = Hashtable.newFrom({"Icon": thisGDIconObjectsList});
var thisGDCounterObjectsList = [...runtimeScene.getObjects("Counter")];
var GDCounterObjects = Hashtable.newFrom({"Counter": thisGDCounterObjectsList});
var thisGDBackgroundObjectsList = [...runtimeScene.getObjects("Background")];
var GDBackgroundObjects = Hashtable.newFrom({"Background": thisGDBackgroundObjectsList});
var eventsFunctionContext = {
  _objectsMap: {
"Object": Object
, "Icon": GDIconObjects
, "Counter": GDCounterObjects
, "Background": GDBackgroundObjects
},
  _objectArraysMap: {
"Object": thisObjectList
, "Icon": thisGDIconObjectsList
, "Counter": thisGDCounterObjectsList
, "Background": thisGDBackgroundObjectsList
},
  _behaviorNamesMap: {
},
  globalVariablesForExtension: runtimeScene.getGame().getVariablesForExtension("ScoreCounter"),
  sceneVariablesForExtension: runtimeScene.getScene().getVariablesForExtension("ScoreCounter"),
  localVariables: [],
  getObjects: function(objectName) {
    return eventsFunctionContext._objectArraysMap[objectName] || [];
  },
  getObjectsLists: function(objectName) {
    return eventsFunctionContext._objectsMap[objectName] || null;
  },
  getBehaviorName: function(behaviorName) {
    return eventsFunctionContext._behaviorNamesMap[behaviorName] || behaviorName;
  },
  createObject: function(objectName) {
    const objectsList = eventsFunctionContext._objectsMap[objectName];
    if (objectsList) {
      const object = parentEventsFunctionContext ?
        parentEventsFunctionContext.createObject(objectsList.firstKey()) :
        runtimeScene.createObject(objectsList.firstKey());
      if (object) {
        objectsList.get(objectsList.firstKey()).push(object);
        eventsFunctionContext._objectArraysMap[objectName].push(object);
      }
      return object;    }
    return null;
  },
  getInstancesCountOnScene: function(objectName) {
    const objectsList = eventsFunctionContext._objectsMap[objectName];
    let count = 0;
    if (objectsList) {
      for(const objectName in objectsList.items)
        count += parentEventsFunctionContext ?
parentEventsFunctionContext.getInstancesCountOnScene(objectName) :
        runtimeScene.getInstancesCountOnScene(objectName);
    }
    return count;
  },
  getLayer: function(layerName) {
    return runtimeScene.getLayer(layerName);
  },
  getArgument: function(argName) {
    return "";
  },
  getOnceTriggers: function() { return that._onceTriggers; }
};

gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.onCreatedContext.GDObjectObjects1.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.onCreatedContext.GDObjectObjects2.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.onCreatedContext.GDIconObjects1.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.onCreatedContext.GDIconObjects2.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.onCreatedContext.GDCounterObjects1.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.onCreatedContext.GDCounterObjects2.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.onCreatedContext.GDBackgroundObjects1.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.onCreatedContext.GDBackgroundObjects2.length = 0;

gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.onCreatedContext.eventsList0(runtimeScene, eventsFunctionContext);
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.onCreatedContext.GDObjectObjects1.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.onCreatedContext.GDObjectObjects2.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.onCreatedContext.GDIconObjects1.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.onCreatedContext.GDIconObjects2.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.onCreatedContext.GDCounterObjects1.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.onCreatedContext.GDCounterObjects2.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.onCreatedContext.GDBackgroundObjects1.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.onCreatedContext.GDBackgroundObjects2.length = 0;

gdjs.CustomRuntimeObject.prototype.onCreated.call(this);

return;
}
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext = {};
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDObjectObjects1= [];
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDObjectObjects2= [];
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDObjectObjects3= [];
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDIconObjects1= [];
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDIconObjects2= [];
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDIconObjects3= [];
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDCounterObjects1= [];
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDCounterObjects2= [];
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDCounterObjects3= [];
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDBackgroundObjects1= [];
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDBackgroundObjects2= [];
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDBackgroundObjects3= [];


gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.eventsList0 = function(runtimeScene, eventsFunctionContext) {

{

gdjs.copyArray(gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDCounterObjects1, gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDCounterObjects2);


let isConditionTrue_0 = false;
isConditionTrue_0 = false;
for (var i = 0, k = 0, l = gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDCounterObjects2.length;i<l;++i) {
    if ( gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDCounterObjects2[i].getBehavior(eventsFunctionContext.getBehaviorName("Text")).getText() != ("" + eventsFunctionContext.getObjects("Object")[0]._getScore()) ) {
        isConditionTrue_0 = true;
        gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDCounterObjects2[k] = gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDCounterObjects2[i];
        ++k;
    }
}
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDCounterObjects2.length = k;
if (isConditionTrue_0) {
/* Reuse gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDCounterObjects2 */
{for(var i = 0, len = gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDCounterObjects2.length ;i < len;++i) {
    gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDCounterObjects2[i].getBehavior(eventsFunctionContext.getBehaviorName("RollingCounter")).SetValue(eventsFunctionContext.getObjects("Object")[0]._getScore(), (typeof eventsFunctionContext !== 'undefined' ? eventsFunctionContext : undefined));
}
}}

}


{


let isConditionTrue_0 = false;
{
gdjs.copyArray(eventsFunctionContext.getObjects("Icon"), gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDIconObjects2);
{for(var i = 0, len = gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDIconObjects2.length ;i < len;++i) {
    gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDIconObjects2[i].getBehavior(eventsFunctionContext.getBehaviorName("ShakeObject_PositionAngleScale")).ShakeObject_PositionAngleScale(0.3, 0, 0, 0, 25, 0.1, false, (typeof eventsFunctionContext !== 'undefined' ? eventsFunctionContext : undefined));
}
}}

}


{


let isConditionTrue_0 = false;
{
gdjs.copyArray(gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDCounterObjects1, gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDCounterObjects2);

{for(var i = 0, len = gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDCounterObjects2.length ;i < len;++i) {
    gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDCounterObjects2[i].getBehavior(eventsFunctionContext.getBehaviorName("ShakeObject_PositionAngleScale")).ShakeObject_PositionAngleScale(0.2, 0, 10, 0, 0, 0.1, false, (typeof eventsFunctionContext !== 'undefined' ? eventsFunctionContext : undefined));
}
}}

}


{


let isConditionTrue_0 = false;
isConditionTrue_0 = false;
{isConditionTrue_0 = eventsFunctionContext.getOnceTriggers().triggerOnce(17585556);
}
if (isConditionTrue_0) {
{gdjs.evtTools.sound.playSound(runtimeScene, "Collect coin 1.wav", false, 100, eventsFunctionContext.sceneVariablesForExtension.getFromIndex(0).getAsNumber());
}{eventsFunctionContext.sceneVariablesForExtension.getFromIndex(0).mul(1.01);
}{gdjs.evtTools.runtimeScene.resetTimer(runtimeScene, "RisingPitch");
}}

}


{


let isConditionTrue_0 = false;
isConditionTrue_0 = false;
isConditionTrue_0 = gdjs.evtTools.runtimeScene.getTimerElapsedTimeInSecondsOrNaN(runtimeScene, "RisingPitch") > 1;
if (isConditionTrue_0) {
isConditionTrue_0 = false;
{isConditionTrue_0 = eventsFunctionContext.getOnceTriggers().triggerOnce(17587716);
}
}
if (isConditionTrue_0) {
{eventsFunctionContext.sceneVariablesForExtension.getFromIndex(0).setNumber(0.8);
}}

}


};gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.eventsList1 = function(runtimeScene, eventsFunctionContext) {

{


gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.eventsList0(runtimeScene, eventsFunctionContext);
}


};gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.eventsList2 = function(runtimeScene, eventsFunctionContext) {

{

gdjs.copyArray(eventsFunctionContext.getObjects("Counter"), gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDCounterObjects1);

let isConditionTrue_0 = false;
isConditionTrue_0 = false;
for (var i = 0, k = 0, l = gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDCounterObjects1.length;i<l;++i) {
    if ( gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDCounterObjects1[i].getBehavior(eventsFunctionContext.getBehaviorName("Text")).getText() != ("" + eventsFunctionContext.getObjects("Object")[0]._getScore()) ) {
        isConditionTrue_0 = true;
        gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDCounterObjects1[k] = gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDCounterObjects1[i];
        ++k;
    }
}
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDCounterObjects1.length = k;
if (isConditionTrue_0) {

{ //Subevents
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.eventsList1(runtimeScene, eventsFunctionContext);} //End of subevents
}

}


};

gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEvents = function(parentEventsFunctionContext) {

var that = this;
var runtimeScene = this._instanceContainer;
var thisObjectList = [this];
var Object = Hashtable.newFrom({Object: thisObjectList});
var thisGDIconObjectsList = [...runtimeScene.getObjects("Icon")];
var GDIconObjects = Hashtable.newFrom({"Icon": thisGDIconObjectsList});
var thisGDCounterObjectsList = [...runtimeScene.getObjects("Counter")];
var GDCounterObjects = Hashtable.newFrom({"Counter": thisGDCounterObjectsList});
var thisGDBackgroundObjectsList = [...runtimeScene.getObjects("Background")];
var GDBackgroundObjects = Hashtable.newFrom({"Background": thisGDBackgroundObjectsList});
var eventsFunctionContext = {
  _objectsMap: {
"Object": Object
, "Icon": GDIconObjects
, "Counter": GDCounterObjects
, "Background": GDBackgroundObjects
},
  _objectArraysMap: {
"Object": thisObjectList
, "Icon": thisGDIconObjectsList
, "Counter": thisGDCounterObjectsList
, "Background": thisGDBackgroundObjectsList
},
  _behaviorNamesMap: {
},
  globalVariablesForExtension: runtimeScene.getGame().getVariablesForExtension("ScoreCounter"),
  sceneVariablesForExtension: runtimeScene.getScene().getVariablesForExtension("ScoreCounter"),
  localVariables: [],
  getObjects: function(objectName) {
    return eventsFunctionContext._objectArraysMap[objectName] || [];
  },
  getObjectsLists: function(objectName) {
    return eventsFunctionContext._objectsMap[objectName] || null;
  },
  getBehaviorName: function(behaviorName) {
    return eventsFunctionContext._behaviorNamesMap[behaviorName] || behaviorName;
  },
  createObject: function(objectName) {
    const objectsList = eventsFunctionContext._objectsMap[objectName];
    if (objectsList) {
      const object = parentEventsFunctionContext ?
        parentEventsFunctionContext.createObject(objectsList.firstKey()) :
        runtimeScene.createObject(objectsList.firstKey());
      if (object) {
        objectsList.get(objectsList.firstKey()).push(object);
        eventsFunctionContext._objectArraysMap[objectName].push(object);
      }
      return object;    }
    return null;
  },
  getInstancesCountOnScene: function(objectName) {
    const objectsList = eventsFunctionContext._objectsMap[objectName];
    let count = 0;
    if (objectsList) {
      for(const objectName in objectsList.items)
        count += parentEventsFunctionContext ?
parentEventsFunctionContext.getInstancesCountOnScene(objectName) :
        runtimeScene.getInstancesCountOnScene(objectName);
    }
    return count;
  },
  getLayer: function(layerName) {
    return runtimeScene.getLayer(layerName);
  },
  getArgument: function(argName) {
    return "";
  },
  getOnceTriggers: function() { return that._onceTriggers; }
};

gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDObjectObjects1.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDObjectObjects2.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDObjectObjects3.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDIconObjects1.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDIconObjects2.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDIconObjects3.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDCounterObjects1.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDCounterObjects2.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDCounterObjects3.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDBackgroundObjects1.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDBackgroundObjects2.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDBackgroundObjects3.length = 0;

gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.eventsList2(runtimeScene, eventsFunctionContext);
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDObjectObjects1.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDObjectObjects2.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDObjectObjects3.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDIconObjects1.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDIconObjects2.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDIconObjects3.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDCounterObjects1.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDCounterObjects2.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDCounterObjects3.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDBackgroundObjects1.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDBackgroundObjects2.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPostEventsContext.GDBackgroundObjects3.length = 0;


return;
}
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.ScoreContext = {};
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.ScoreContext.GDObjectObjects1= [];
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.ScoreContext.GDObjectObjects2= [];
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.ScoreContext.GDIconObjects1= [];
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.ScoreContext.GDIconObjects2= [];
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.ScoreContext.GDCounterObjects1= [];
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.ScoreContext.GDCounterObjects2= [];
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.ScoreContext.GDBackgroundObjects1= [];
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.ScoreContext.GDBackgroundObjects2= [];


gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.ScoreContext.eventsList0 = function(runtimeScene, eventsFunctionContext) {

{


let isConditionTrue_0 = false;
{
{if (typeof eventsFunctionContext !== 'undefined') { eventsFunctionContext.returnValue = eventsFunctionContext.getObjects("Object")[0]._getScore(); }}}

}


};

gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.Score = function(parentEventsFunctionContext) {

var that = this;
var runtimeScene = this._instanceContainer;
var thisObjectList = [this];
var Object = Hashtable.newFrom({Object: thisObjectList});
var thisGDIconObjectsList = [...runtimeScene.getObjects("Icon")];
var GDIconObjects = Hashtable.newFrom({"Icon": thisGDIconObjectsList});
var thisGDCounterObjectsList = [...runtimeScene.getObjects("Counter")];
var GDCounterObjects = Hashtable.newFrom({"Counter": thisGDCounterObjectsList});
var thisGDBackgroundObjectsList = [...runtimeScene.getObjects("Background")];
var GDBackgroundObjects = Hashtable.newFrom({"Background": thisGDBackgroundObjectsList});
var eventsFunctionContext = {
  _objectsMap: {
"Object": Object
, "Icon": GDIconObjects
, "Counter": GDCounterObjects
, "Background": GDBackgroundObjects
},
  _objectArraysMap: {
"Object": thisObjectList
, "Icon": thisGDIconObjectsList
, "Counter": thisGDCounterObjectsList
, "Background": thisGDBackgroundObjectsList
},
  _behaviorNamesMap: {
},
  globalVariablesForExtension: runtimeScene.getGame().getVariablesForExtension("ScoreCounter"),
  sceneVariablesForExtension: runtimeScene.getScene().getVariablesForExtension("ScoreCounter"),
  localVariables: [],
  getObjects: function(objectName) {
    return eventsFunctionContext._objectArraysMap[objectName] || [];
  },
  getObjectsLists: function(objectName) {
    return eventsFunctionContext._objectsMap[objectName] || null;
  },
  getBehaviorName: function(behaviorName) {
    return eventsFunctionContext._behaviorNamesMap[behaviorName] || behaviorName;
  },
  createObject: function(objectName) {
    const objectsList = eventsFunctionContext._objectsMap[objectName];
    if (objectsList) {
      const object = parentEventsFunctionContext ?
        parentEventsFunctionContext.createObject(objectsList.firstKey()) :
        runtimeScene.createObject(objectsList.firstKey());
      if (object) {
        objectsList.get(objectsList.firstKey()).push(object);
        eventsFunctionContext._objectArraysMap[objectName].push(object);
      }
      return object;    }
    return null;
  },
  getInstancesCountOnScene: function(objectName) {
    const objectsList = eventsFunctionContext._objectsMap[objectName];
    let count = 0;
    if (objectsList) {
      for(const objectName in objectsList.items)
        count += parentEventsFunctionContext ?
parentEventsFunctionContext.getInstancesCountOnScene(objectName) :
        runtimeScene.getInstancesCountOnScene(objectName);
    }
    return count;
  },
  getLayer: function(layerName) {
    return runtimeScene.getLayer(layerName);
  },
  getArgument: function(argName) {
    return "";
  },
  getOnceTriggers: function() { return that._onceTriggers; }
};

gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.ScoreContext.GDObjectObjects1.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.ScoreContext.GDObjectObjects2.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.ScoreContext.GDIconObjects1.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.ScoreContext.GDIconObjects2.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.ScoreContext.GDCounterObjects1.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.ScoreContext.GDCounterObjects2.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.ScoreContext.GDBackgroundObjects1.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.ScoreContext.GDBackgroundObjects2.length = 0;

gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.ScoreContext.eventsList0(runtimeScene, eventsFunctionContext);
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.ScoreContext.GDObjectObjects1.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.ScoreContext.GDObjectObjects2.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.ScoreContext.GDIconObjects1.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.ScoreContext.GDIconObjects2.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.ScoreContext.GDCounterObjects1.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.ScoreContext.GDCounterObjects2.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.ScoreContext.GDBackgroundObjects1.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.ScoreContext.GDBackgroundObjects2.length = 0;


return Number(eventsFunctionContext.returnValue) || 0;
}
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.SetScoreContext = {};
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.SetScoreContext.GDObjectObjects1= [];
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.SetScoreContext.GDObjectObjects2= [];
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.SetScoreContext.GDIconObjects1= [];
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.SetScoreContext.GDIconObjects2= [];
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.SetScoreContext.GDCounterObjects1= [];
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.SetScoreContext.GDCounterObjects2= [];
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.SetScoreContext.GDBackgroundObjects1= [];
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.SetScoreContext.GDBackgroundObjects2= [];


gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.SetScoreContext.eventsList0 = function(runtimeScene, eventsFunctionContext) {

{


let isConditionTrue_0 = false;
{
{eventsFunctionContext.getObjects("Object")[0]._setScore(eventsFunctionContext.getArgument("Value"))
}}

}


};

gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.SetScore = function(Value, parentEventsFunctionContext) {

var that = this;
var runtimeScene = this._instanceContainer;
var thisObjectList = [this];
var Object = Hashtable.newFrom({Object: thisObjectList});
var thisGDIconObjectsList = [...runtimeScene.getObjects("Icon")];
var GDIconObjects = Hashtable.newFrom({"Icon": thisGDIconObjectsList});
var thisGDCounterObjectsList = [...runtimeScene.getObjects("Counter")];
var GDCounterObjects = Hashtable.newFrom({"Counter": thisGDCounterObjectsList});
var thisGDBackgroundObjectsList = [...runtimeScene.getObjects("Background")];
var GDBackgroundObjects = Hashtable.newFrom({"Background": thisGDBackgroundObjectsList});
var eventsFunctionContext = {
  _objectsMap: {
"Object": Object
, "Icon": GDIconObjects
, "Counter": GDCounterObjects
, "Background": GDBackgroundObjects
},
  _objectArraysMap: {
"Object": thisObjectList
, "Icon": thisGDIconObjectsList
, "Counter": thisGDCounterObjectsList
, "Background": thisGDBackgroundObjectsList
},
  _behaviorNamesMap: {
},
  globalVariablesForExtension: runtimeScene.getGame().getVariablesForExtension("ScoreCounter"),
  sceneVariablesForExtension: runtimeScene.getScene().getVariablesForExtension("ScoreCounter"),
  localVariables: [],
  getObjects: function(objectName) {
    return eventsFunctionContext._objectArraysMap[objectName] || [];
  },
  getObjectsLists: function(objectName) {
    return eventsFunctionContext._objectsMap[objectName] || null;
  },
  getBehaviorName: function(behaviorName) {
    return eventsFunctionContext._behaviorNamesMap[behaviorName] || behaviorName;
  },
  createObject: function(objectName) {
    const objectsList = eventsFunctionContext._objectsMap[objectName];
    if (objectsList) {
      const object = parentEventsFunctionContext ?
        parentEventsFunctionContext.createObject(objectsList.firstKey()) :
        runtimeScene.createObject(objectsList.firstKey());
      if (object) {
        objectsList.get(objectsList.firstKey()).push(object);
        eventsFunctionContext._objectArraysMap[objectName].push(object);
      }
      return object;    }
    return null;
  },
  getInstancesCountOnScene: function(objectName) {
    const objectsList = eventsFunctionContext._objectsMap[objectName];
    let count = 0;
    if (objectsList) {
      for(const objectName in objectsList.items)
        count += parentEventsFunctionContext ?
parentEventsFunctionContext.getInstancesCountOnScene(objectName) :
        runtimeScene.getInstancesCountOnScene(objectName);
    }
    return count;
  },
  getLayer: function(layerName) {
    return runtimeScene.getLayer(layerName);
  },
  getArgument: function(argName) {
if (argName === "Value") return Value;
    return "";
  },
  getOnceTriggers: function() { return that._onceTriggers; }
};

gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.SetScoreContext.GDObjectObjects1.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.SetScoreContext.GDObjectObjects2.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.SetScoreContext.GDIconObjects1.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.SetScoreContext.GDIconObjects2.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.SetScoreContext.GDCounterObjects1.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.SetScoreContext.GDCounterObjects2.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.SetScoreContext.GDBackgroundObjects1.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.SetScoreContext.GDBackgroundObjects2.length = 0;

gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.SetScoreContext.eventsList0(runtimeScene, eventsFunctionContext);
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.SetScoreContext.GDObjectObjects1.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.SetScoreContext.GDObjectObjects2.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.SetScoreContext.GDIconObjects1.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.SetScoreContext.GDIconObjects2.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.SetScoreContext.GDCounterObjects1.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.SetScoreContext.GDCounterObjects2.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.SetScoreContext.GDBackgroundObjects1.length = 0;
gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.SetScoreContext.GDBackgroundObjects2.length = 0;


return;
}

gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter.prototype.doStepPreEvents = function() {
  this._onceTriggers.startNewFrame();
};


gdjs.registerObject("ScoreCounter::ScoreCounter", gdjs.evtsExt__ScoreCounter__ScoreCounter.ScoreCounter);
