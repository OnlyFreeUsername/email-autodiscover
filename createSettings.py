import argparse
import json

parser = argparse.ArgumentParser(
    description='Write the mailconfig settings file.')
parser.add_argument('domain', help='The root domain of the mailserver.')
parser.add_argument(
    '--company',
    default=None,
    help='The name of the company (defaults to "domain Mailserver").')
parser.add_argument(
    '--url',
    default=None,
    help='The support url of the mailserver host (defaults to domain root).')
parser.add_argument(
    '--imap-host',
    default=None,
    help='The subdomain that the IMAP server listens to (defaults to mail.domain.tld).'
)
parser.add_argument('--imap-port',
                    default=993,
                    type=int,
                    help='The IMAP server port.')
parser.add_argument('--imap-socket',
                    default="SSL",
                    help='The IMAP socket security type.')
parser.add_argument(
    '--smtp-host',
    default=None,
    help='The domain that the SMTP server listens to (defaults to mail.domain.tld).'
)
parser.add_argument('--smtp-port',
                    default=465,
                    type=int,
                    help='The SMTP server port.')
parser.add_argument('--smtp-socket',
                    default="SSL",
                    help='The SMTP socket security type.')

args = parser.parse_args()
apex_domain = args.domain
company_name = args.company or f"{apex_domain} Mailserver"
support_url = args.url or f"https://{apex_domain}/"
imap_host = args.imap_host or f"mail.{apex_domain}"
smtp_host = args.smtp_host or f"mail.{apex_domain}"

with open("settings.json", "w") as f:
    json.dump(
        {
            "info": {
                "name": company_name,
                "url": support_url,
                "domain": apex_domain
            },
            "server": {
                "imap": {
                    "host": imap_host,
                    "port": args.imap_port,
                    "socket": args.imap_socket
                },
                "smtp": {
                    "host": smtp_host,
                    "port": args.smtp_port,
                    "socket": args.smtp_socket
                },
                "domain_required": True
            },
            "ttl": 168
        },
        f,
        indent=4)
