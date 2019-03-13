# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, -40.34, 16.38, 21.63, -63.30, 12.62, -12.51, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, -47.14, 33.93, -1.19, -56.83, -4.62, 9.57, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, -35.87, 7.57, -5.87, -70.72, 22.42, 15.93, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_B_3')
