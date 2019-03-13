# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, -8.07, 11.69, 8.81, -32.24, 1.69, -23.36, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, -17.88, 25.99, -14.47, -21.93, -12.09, 0.42, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, -1.02, 0.05, -19.06, -36.27, 12.62, 3.51, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_B_6')
