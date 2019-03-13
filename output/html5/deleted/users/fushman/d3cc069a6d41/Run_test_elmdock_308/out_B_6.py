# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, -15.48, 23.60, 23.30, -39.65, 13.63, -8.91, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, -25.27, 37.91, 0.02, -29.35, -0.17, 14.87, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, -8.43, 11.97, -4.59, -43.68, 24.55, 17.98, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_B_6')
