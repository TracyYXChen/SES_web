# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, -5.73, 15.09, 21.39, -29.86, 4.91, -10.62, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, -15.58, 29.32, -1.92, -19.52, -8.76, 13.15, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, 1.33, 3.35, -6.42, -33.92, 15.93, 16.16, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_B_1')
