# xmas2019
See https://tech.feedyourhead.at/content/hackaday-a-christmas-machine

## Install Joy-IT TFT3.2

Edit /boot/config.txt

```
dtparam=spi=on
dtoverlay=joy-IT-Display-Driver-32b-overlay:rotate=270,swapxy=1
```

Edit /boot/cmdline.txt and add "fbcon=map:10"

```
console=serial0,115200 console=tty1 root=PARTUUID=6c586e13-02 rootfstype=ext4 elevator=deadline fsck.repair=yes rootwait fbcon=map:10
```

Install xorg-modules:
```
apt-get install xorg xorg-docs-core xserver-xorg xserver-xorg-core xserver-xorg-input-all xserver-xorg-input-libinput xserver-xorg-input-wacom xserver-xorg-legacy xserver-xorg-video-all xserver-xorg-video-amdgpu xserver-xorg-video-ati xserver-xorg-video-fbdev xserver-xorg-video-fbturbo xserver-xorg-video-nouveau xserver-xorg-video-radeon xserver-xorg-video-vesa
```

Edit /usr/share/X11/xorg.conf.d/99-calibration.conf:

```
Section "InputClass"
        Identifier      "calibration"
        MatchProduct    "ADS7846 Touchscreen"
        Option  "Calibration"   "160 3723 3896 181"
        Option  "SwapAxes"      "1"
        Option "TransformationMatrix" "1 0 0 0 -1 1 0 0 1"
EndSection
```

Edit /usr/share/X11/xorg.conf.d/99-fbturbo.conf and set fbdev to "/dev/fb1"

```
Section "Device"
        Identifier      "Allwinner A10/A13 FBDEV"
        Driver          "fbturbo"
        Option          "fbdev" "/dev/fb1"
        Option          "SwapbuffersWait" "true"
EndSection
```
Install the driver:

```
cd /tmp
wget anleitung.joy-it.net/upload/joy-IT-Display-Driver-32b-overlay.dtbsudo
cp joy-IT-Display-Driver-32b-overlay.dtb /boot/overlays/joy-IT-Display-Driver-32b-overlay.dtbo
```

Install the LXDE-desktop:
```
apt-get install lxde-common lxde-core lxde-icon-theme lxde-settings-daemon openbox-lxde-session lightdm lightdm-gtk-greeter
```

Set autologin for user pi in lightdm:
```
autologin-guest=false
autologin-user=pi
autologin-user-timeout=0
```

Edit /etc/xdg/lxsession/LXDE/autostart:

```
@lxpanel --profile LXDE
@pcmanfm --desktop --profile LXDE
@xset s off
@xset -dpms
@xset s noblank
```

Reboot

Edit /home/pi/.config/lxsession/LXDE/autostart:

```
@lxpanel --profile LXDE
@pcmanfm --desktop --profile LXDE
@/home/pi/startxmas.sh
@xset s off
@xset -dpms
@xset s noblank
```

Remove software:
```
apt-get remove light-locker wpasupplicant
```

Install software:
```
apt-get install hostapd dnsmasq apache2 php7.3 php7.3-cli php7.3-json chromium-browser unclutter git
```

Edit /etc/hostapd/hostapd.conf:
```
interface=wlan0
driver=nl80211
ssid=xmas
hw_mode=g
channel=11
# wpa=1
# wpa_passphrase=SECRETPASSWORD
# wpa_key_mgmt=WPA-PSK
# wpa_pairwise=TKIP CCMP
# wpa_ptk_rekey=600
macaddr_acl=0
```

Edit /etc/dhcpcd.conf and add the following lines at the end of the file:
```
interface wlan0
static ip_address=10.0.0.1/24
```

Edit /etc/dnsmasq.d/dhcp:

```
dhcp-authoritative
dhcp-range=10.0.0.50,10.0.0.150,12h
```

Edit /etc/dnsmasq.d/dns:

```
address=/\#/10.0.0.1
```
Edit /etc/dnsmasq.d/interfaces:

```
interface=wlan0
```

Edit /etc/default/hostapd and modify DAEMON_CONF:

```
DAEMON_CONF="/etc/hostapd/hostapd.conf"
```

Configure autostart of hostapd:

```
systemctl daemon-reload
systemctl unmask hostapd
systemctl enable hostapd
```

Edit /home/pi/startxmas.sh:


```
#!/bin/bash

DISPLAY=:0.0 unclutter &
DISPLAY=:0.0 chromium-browser --kiosk --disable-restore-session-state --disable-features=TranslateUI --disable-session-crashed-bubble http://localhost/tree.html
```

Download the Webfiles:

```
git clone https://github.com/whotwagner/xmas2019.git /tmp/xmas2019
cp -r /tmp/xmas2019/* /var/www/html/
chown www-data /var/www/html/wishes
```
Reboot

