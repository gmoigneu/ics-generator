<?php

namespace App\Http\Controllers;

use Sabre\VObject;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;

class IcsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    //

    public function index()
    {
        $startDate = new \DateTime();
        $endDate = new \DateTime();
        $startDate->add(new \DateInterval('PT1H'));
        $endDate->add(new \DateInterval('PT2H'));

        return view('index', [
            'startDate' => $startDate->format('Y-m-d H:i:s'),
            'endDate' => $endDate->format('Y-m-d H:i:s'),
            'timezones' => \DateTimeZone::listIdentifiers(),
        ]);
    }

    public function generate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'organizer' => 'email',
            'start' => 'required|date_format:"Y-m-d H:i:s"',
            'end' => 'required|date_format:"Y-m-d H:i:s"',
            'timezone' => 'required|timezone',
            'description' => 'string',
            'location' => 'string|max:100'
        ]);

        $startDate = new \DateTime();
        $endDate = new \DateTime();
        $startDate->add(new \DateInterval('PT1H'));
        $endDate->add(new \DateInterval('PT2H'));

        if ($validator->fails()) {
            return view('index', ['errors' => $validator->errors()] + $request->all() + ['timezones' => \DateTimeZone::listIdentifiers(), 'startDate' => $startDate->format('Y-m-d H:i:s'),
            'endDate' => $endDate->format('Y-m-d H:i:s')]
            );
        }

        $vcalendar = new VObject\Component\VCalendar();
        $vevent = $vcalendar->add('VEVENT', [
            'SUMMARY'     => $request->input('name'),
            'DTSTART'     => new \DateTime($request->input('start'), new \DateTimeZone($request->input('timezone'))),
            'DTEND'       => new \DateTime($request->input('end'), new \DateTimeZone($request->input('timezone'))),
            'DESCRIPTION' => $request->input('description'),
            'LOCATION'    => $request->input('location'),
        ]);

        if ($request->has('organizer') && !empty($request->get('organizer'))) {
            $vevent->add('ORGANIZER','mailto:'.$request->input('organizer'));
        }

        if ($request->input('alarm') != 'none') {
            $vevent->add('VALARM', [
                'TRIGGER' => $request->input('alarm'),
                'REPEAT' => 1,
                'DURATION' => 'PT5M',
                'ACTION' => 'DISPLAY',
                'DESCRIPTION' => $request->input('name')
            ]);
        }

        return response($vcalendar->serialize())
            ->header('Content-type', 'text/vcalendar')
            ->header('Content-Disposition', 'attachment; filename="' . str_slug($request->input('name')) .'.ics"');
    }
}
