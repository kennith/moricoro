# Moricoro

Moricoro is inspired by the mobile ticket system I saw when visiting the Ghibli park in Aichi, Nagoya.

## Background

I was visiting the Ghibli park in Nagoya with my family. In certain areas, we need to purchase tickets ahead of time to enter certain exhibitions. At the gate, the staff scanned the QR code of our tickets that are retrieved from a website. Each ticket was on its on screen and the staff validated the ticket by scanning the QR code of the ticket from their device. Initially, I thought we would have to scroll through the screen on each scan. On my surprise, the screen automatically advance to the next ticket after the staff scans the ticket from their device. I was amazed how convenient this is especially there was a light rain going on. Without the auto advance feature, it would be a bit annoying to juggle between carrying the umbrella and scrolling screen. Even without the rain, it would be very nice to go through the scanning process without scrolling the screen. 

## Challenge

I really like this auto advance feature, I tinker about how to accomplish this. I understand there are two parts. The first part is to retrieve the tickets that are purchased in the group and displayed their ticket as a QR code. The second part is to somehow when the QR code is scanned and the device displaying the ticket moves to the next ticket. 

The live communication between a server and a client can be communicate through web socket. Laravel Reverb is a good package to accomplish this. 

## Setup

- Laravel (Foundation)
- Laravel Reverb (Web socket)
- Vue (Front end)
- InertiaJS 
- bacon/bacon-qr-code (Display QR)

### Laravel

- `composer install`
- `docker compose up -d --build`

### Front end development

1. `npm install`
2. `npm run dev`

### Reverb

1. `php artisan reverb:start`
2. `php artisan queue:work`

Once the above is setup, visit with url: `http://localhost:8000/ticket/d422ac76-5d86-4d32-943b-5a6769af8e98`

You can either scan the barcode shown on the screen as the staff at the ticket gate or you can run the command `php artisan app:scan-ticket` as if you scanned the ticket. 

## Conclusion

I am aware this is just a feature of a ticketing system. There are more work to be down if this become a real ticketing system. For example, user registration, payment, reservation, and email confirmation, etc. 

However, what I am impressed is I can do this feature without getting a service provider to host web socket or sophisticated infrastructure. 

Any solo developer with curiosity and time, they can do this anywhere with their computer using the open source packages freely available on the Internet. 

What a time to be a solo developer. 
