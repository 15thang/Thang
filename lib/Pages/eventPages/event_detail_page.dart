import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:flutter/widgets.dart';
import 'package:http/http.dart' as http;
import 'package:wfl_app/model/event.dart';
import 'package:wfl_app/model/redbluecorner.dart';

class EventsDetailPage extends StatefulWidget {
  //Declare a field that holds the Event.
  final Event event;

  // In the constructor, require a Event.
  EventsDetailPage({Key key, @required this.event}) : super(key: key);

  @override
  _EventPageState createState() => _EventPageState();
}

class _EventPageState extends State<EventsDetailPage> {
  List<Corners> _notes = List<Corners>();

  Future<List<Corners>> fetchNotes() async {
    var url = 'http://superfighter.nl/APP_output_bluecorner.php?event_id=' +
        '${widget.event.eventId}';

    var response = await http.get(url);

    var notes = List<Corners>();

    if (response.statusCode == 200) {
      var notesJson = json.decode(response.body);

      for (var noteJson in notesJson) {
        notes.add(Corners.fromJson(noteJson));
      }
    }
    return notes;
  }

  @override
  void initState() {
    fetchNotes().then((value) {
      setState(() {
        _notes.addAll(value);
      });
    });
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.grey[800],
      appBar: AppBar(
          title: Text('${widget.event.eventName}'),
          actions: <Widget>[],
          backgroundColor: Colors.red[900]),
      body: new Container(
        child: Column(
          children: <Widget>[
            Container(
              height: 250,
              width: 415,
              child: Image.network('${widget.event.eventPicture}',
                  fit: BoxFit.fill),
              padding: EdgeInsets.only(bottom: 8.0),
              margin: EdgeInsets.only(bottom: 8.0),
            ),
            Container(
              height: 50,
              child: Text(
                '${widget.event.eventDescription}' +
                    " " +
                    '${widget.event.eventId}',
                style: TextStyle(
                  color: Colors.grey[100],
                  fontSize: 16,
                  fontWeight: FontWeight.bold,
                ),
                textAlign: TextAlign.left,
              ),
            ),
            Expanded(
              child: ListView.builder(
                itemBuilder: (context, index) {
                  //Change numbers to names
                  String redcornerWeightclass =
                      _notes[index].redcornerWeightclass;
                  switch (redcornerWeightclass) {
                    case "0":
                        redcornerWeightclass = "";
                        break;
                    case "1":
                        redcornerWeightclass = "95+";
                        break;
                    case "2":
                        redcornerWeightclass = "95";
                        break;
                    case "3":
                        redcornerWeightclass = "84";
                        break;
                    case "4":
                        redcornerWeightclass = "77";
                        break;
                    case "5":
                        redcornerWeightclass = "70";
                        break;
                    case "6":
                        redcornerWeightclass = "65";
                        break;
                    case "7":
                        redcornerWeightclass = "61";
                        break;
                    case "8":
                        redcornerWeightclass = "56";
                        break;
                    case "9":
                        redcornerWeightclass = "52";
                        break;
                    case "10":
                        redcornerWeightclass = "48";
                        break;
                    case "11":
                        redcornerWeightclass = "44";
                        break;
                    case "12":
                        redcornerWeightclass = "40";
                        break;
                    case "13":
                        redcornerWeightclass = "36";
                        break;
                    case "14":
                        redcornerWeightclass = "32";
                        break;
                }
                  String redcornerGrade = _notes[index].redcornerGrade;
                  switch (redcornerGrade) {
                    case "0":
                      redcornerGrade = "";
                      break;
                    case "1":
                      redcornerGrade = "A";
                      break;
                    case "2":
                      redcornerGrade = "B";
                      break;
                    case "3":
                      redcornerGrade = "C";
                      break;
                    case "4":
                      redcornerGrade = "N";
                      break;
                    case "5":
                      redcornerGrade = "J";
                      break;
                  }
                  return new GestureDetector(
                    onTap: () {
                      /*Navigator.push(
                        context,
                        MaterialPageRoute(
                          builder: (context) =>
                              AthletesDetailPage(athlete: _notes[index]),
                        ),
                      );*/
                    },
                    child: new Card(
                      color: Colors.blueGrey[50],
                      elevation: 5,
                      child: Row(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: <Widget>[
                          //redcorner
                          Container(
                            height: 220,
                            width: 150,
                            decoration: BoxDecoration(
                              borderRadius: BorderRadius.only(
                                  bottomLeft: Radius.circular(5),
                                  topLeft: Radius.circular(5)),
                            ),
                            child: Column(
                              crossAxisAlignment: CrossAxisAlignment.start,
                              children: <Widget>[
                                //red corner
                                Container(
                                  width: 130,
                                  height: 130,
                                  decoration: BoxDecoration(
                                    borderRadius: BorderRadius.only(
                                        bottomLeft: Radius.circular(5),
                                        topLeft: Radius.circular(5)),
                                    image: new DecorationImage(
                                        image: new NetworkImage(
                                            _notes[index].redcornerPicture),
                                        fit: BoxFit.cover),
                                  ),
                                ),
                                //red corner
                                Container(
                                  padding: const EdgeInsets.all(10),
                                  height: 90,
                                  child: Column(
                                    crossAxisAlignment:
                                        CrossAxisAlignment.start,
                                    children: <Widget>[
                                      Text(_notes[index].redcornerFullName,
                                          style: TextStyle(
                                              fontWeight: FontWeight.bold)),
                                      Text(_notes[index].redcornerNickname),
                                      Text(_notes[index].redcornerNationality),
                                    ],
                                  ),
                                ),
                              ],
                            ),
                          ),
                          //vs
                          Container(
                            padding: const EdgeInsets.only(top: 30),
                            child: Column(
                              crossAxisAlignment: CrossAxisAlignment.center,
                              children: <Widget>[
                                Text('Weight: ' + redcornerWeightclass),
                                Text('Grade: ' + redcornerGrade),
                                Text(' '),
                                Text('VS',
                                    style:
                                        TextStyle(fontWeight: FontWeight.bold)),
                              ],
                            ),
                          ),
                          //blue corner
                          Container(
                            height: 220,
                            width: 187.4,
                            decoration: BoxDecoration(
                              borderRadius: BorderRadius.only(
                                  bottomLeft: Radius.circular(5),
                                  topLeft: Radius.circular(5)),
                            ),
                            child: Column(
                              crossAxisAlignment: CrossAxisAlignment.end,
                              children: <Widget>[
                                //red corner
                                Container(
                                  width: 130,
                                  height: 130,
                                  decoration: BoxDecoration(
                                    borderRadius: BorderRadius.only(
                                        bottomLeft: Radius.circular(5),
                                        topLeft: Radius.circular(5)),
                                    image: new DecorationImage(
                                        image: new NetworkImage(
                                            _notes[index].bluecornerPicture),
                                        fit: BoxFit.cover),
                                  ),
                                ),
                                //red corner
                                Container(
                                  padding: const EdgeInsets.all(10),
                                  height: 90,
                                  child: Column(
                                    crossAxisAlignment:
                                        CrossAxisAlignment.start,
                                    children: <Widget>[
                                      Text(_notes[index].bluecornerFullName,
                                          style: TextStyle(
                                              fontWeight: FontWeight.bold)),
                                      Text(_notes[index].bluecornerNickname),
                                      Text(_notes[index].bluecornerNationality),
                                    ],
                                  ),
                                ),
                              ],
                            ),
                          ),
                        ],
                      ),
                    ),
                  );
                },
                itemCount: _notes.length,
              ),
            ),
          ],
        ),
      ),
    );
  }
}
