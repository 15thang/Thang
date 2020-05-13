import 'dart:convert';
import 'dart:ui';
import 'package:flutter/material.dart';
import 'package:flutter/widgets.dart';
import 'package:http/http.dart' as http;
import 'package:url_launcher/url_launcher.dart';
import 'package:wfl_app/Pages/EventDetailPage.dart';
import '../model/event.dart';
import 'EventPagePast.dart';

class EventPage extends StatefulWidget {
  @override
  _EventPageState createState() => _EventPageState();
}

//Future is to launch URL buttons (like buy ticket)
Future launchURL(String url) async {
  if (await canLaunch(url)) {
    await launch(url, forceWebView: true, forceSafariVC: true);
  } else {
    print("Can't Launch");
  }
}

class _EventPageState extends State<EventPage> {
  static String routeName;

  List<Event> _notes = List<Event>();

  Future<List<Event>> fetchNotes() async {
    var url = 'http://superfighter.nl/APP_output_event.php';
    var response = await http.get(url);

    var notes = List<Event>();

    if (response.statusCode == 200) {
      var notesJson = json.decode(response.body);
      for (var noteJson in notesJson) {
        notes.add(Event.fromJson(noteJson));
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
      appBar: AppBar(
        backgroundColor: Colors.black,
        title: Text('Events', style: TextStyle(fontSize: 20)),
        actions: <Widget>[
            Center(
              child: RaisedButton(
                child: Text('Past events'),
                color: Colors.redAccent,
                onPressed: () 
                {
                  // Navigate to second route when tapped.
                  Navigator.push(context, new MaterialPageRoute(
                  builder: (context) => EventPagePast()
                ));
                },
              ),
            ),
          ],
      ),
      body: ListView.builder(
        itemBuilder: (context, index) {
          return new GestureDetector(
            onTap: () {
              Navigator.push(
                context,
                MaterialPageRoute(
                  builder: (context) => EventsDetailPage(event: _notes[index]),
                ),
              );
            },
            child: new Card(
              color: Colors.blueGrey[100],
              elevation: 5,
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: <Widget>[
                  Container(
                    height: 265,
                    width: 400,
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.only(
                          bottomLeft: Radius.circular(5),
                          topLeft: Radius.circular(5)),
                    ),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: <Widget>[
                        Container(
                          height: 200,
                          width: 400,
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: <Widget>[
                              Container(
                                height: 200,
                                decoration: BoxDecoration(
                                  borderRadius: BorderRadius.only(
                                      topLeft: Radius.circular(5),
                                      topRight: Radius.circular(5)),
                                  image: new DecorationImage(
                                      image: new NetworkImage(
                                          _notes[index].eventPicture),
                                      fit: BoxFit.cover),
                                ),
                              ),
                            ],
                          ),
                        ),
                        Container(
                          height: 65,
                          width: 400,
                          child: Row(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: <Widget>[
                              Container(
                                  width: 230,
                                  padding:
                                      const EdgeInsets.only(top: 7, left: 10),
                                  child: Column(
                                    crossAxisAlignment:
                                        CrossAxisAlignment.start,
                                    children: <Widget>[
                                      Text(_notes[index].eventName,
                                          style: TextStyle(
                                              fontWeight: FontWeight.bold)),
                                      Text(_notes[index].eventDate),
                                      Text(_notes[index].eventPlace),
                                      SizedBox(
                                        height: 10,
                                      ),
                                    ],
                                  )),
                              Container(
                                margin: const EdgeInsets.only(left: 6.0),
                                padding: const EdgeInsets.all(5),
                                child: Row(
                                  crossAxisAlignment: CrossAxisAlignment.start,
                                  children: <Widget>[
                                    RaisedButton(
                                      onPressed: () {
                                        launchURL(
                                            _notes[index].eventTicketLink);
                                      },
                                      child: Text(
                                        'Buy Tickets',
                                        style: TextStyle(
                                          color: Colors.white,
                                        ),
                                      ),
                                      color: Colors.lightBlue[400],
                                    ),
                                    SizedBox(
                                      height: 10,
                                    ),
                                  ],
                                ),
                              ),
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
    );
  }
  /*@override
  Widget build(BuildContext context) {
    final List<Widget> widgets = List(eventList.length);
    for (var i = 0; i < eventList.length; i++) {
      widgets[i] = GestureDetector(
          onTap: () {
            Navigator.push(
              context,
              MaterialPageRoute(
                builder: (context) => EventsDetailPage(event: eventList[i]),  
              ),
            );
            print("Container clicked " + i.toString());
          },
          child: Container(
            child: Column(
              children: <Widget>[
                Card(
                  color: Colors.blueGrey[50],
                  elevation: 5,
                  child: Row(
                    children: <Widget>[
                      Container(
                        height: 200,
                        width: 174,
                        decoration: BoxDecoration(
                          borderRadius: BorderRadius.only(
                              bottomLeft: Radius.circular(5),
                              topLeft: Radius.circular(5)),
                          image: DecorationImage(
                            fit: BoxFit.cover,
                            image: NetworkImage(eventList[i].imageUrl),
                          ),
                        ),
                      ),
                      Container(
                          padding: const EdgeInsets.all(10),
                          height: 150,
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: <Widget>[
                              Text(
                                eventList[i].title,
                                style: TextStyle(
                                  fontSize: 16,
                                  fontWeight: FontWeight.bold,
                                ),
                              ),
                              SizedBox(
                                height: 10,
                              ),
                              Container(
                                  width: 170,
                                  child: Text(eventList[i].description)),
                            ],
                          )
                          )
                    ],
                  ),
                ),
                SizedBox(
                  height: 10,
                ),
              ],
            ),
          ));
    }

    return Container(
        height: double.infinity,
        padding: const EdgeInsets.symmetric(horizontal: 10),
        child: ListView(
          children: widgets.toList(),
        ));
  }*/
}
