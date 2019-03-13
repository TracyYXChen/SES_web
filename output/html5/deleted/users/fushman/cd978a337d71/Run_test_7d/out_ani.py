# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 16.09, 0.40, 1.66, -14.52, -1.12, -1.52, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, 1.79, 4.15, -18.15, -1.32, -4.37, 15.87, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, 1.68, -20.91, -5.00, -1.61, 22.85, 5.66, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_ani')
